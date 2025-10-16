<?php
include '../admin/lib/db.php';
// ---------------------------
// Database connection
// ---------------------------
$pdo = dbConn();
// ---------------------------
// Helper functions
// ---------------------------
function wp_get_json($url)
{
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/119.0 Safari/537.36',
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_REFERER => 'https://movie-khmer.com',
    ]);
    $res = curl_exec($ch);
    curl_close($ch);
    return $res ? json_decode($res, true) : false;
}

function download_image($url)
{

    $saveDir = dirname(__DIR__) . '/images/';
    if (!is_dir($saveDir)) mkdir($saveDir, 0755, true);

    $ext = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
    if (!$ext) $ext = 'jpg';
    $filename = uniqid() . '.' . $ext;
    $savePath = rtrim($saveDir, '/') . '/' . $filename;

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/119.0 Safari/537.36',
        CURLOPT_REFERER => 'https://movie-khmer.com', 
    ]);

    $data = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlErr = curl_error($ch);
    curl_close($ch);

    if ($data && $httpcode == 200) {
        file_put_contents($savePath, $data);
        return $savePath;
    } else {
        echo "⚠️ Failed to download image: $url (HTTP $httpcode, CURL Error: $curlErr)\n";
        return null;
    }
}


// ---------------------------
// Fetch latest dramas
// ---------------------------
echo "Fetching latest dramas...\n";
$posts = wp_get_json("https://movie-khmer.com/wp-json/wp/v2/posts?per_page=100&page=1");

if (!$posts) {
    die("❌ Failed to fetch posts!\n");
}

$addedNew = false;

foreach ($posts as $post) {
    // ----- Check drama exists -----
    $stmt = $pdo->prepare("SELECT id FROM dramas WHERE wp_id = ?");
    $stmt->execute([$post['id']]);
    $drama = $stmt->fetch();

    // ----- Download featured image if new -----
    $img = null;
    if (!$drama && !empty($post['featured_media'])) {
        $media = wp_get_json("https://movie-khmer.com/wp-json/wp/v2/media/{$post['featured_media']}");
        if ($media && !empty($media['source_url'])) {
            $img_url = $media['source_url'];

            // Download image
            $saveDir = dirname(__DIR__) . '/images/';
            if (!is_dir($saveDir)) mkdir($saveDir, 0755, true);

            $ext = pathinfo(parse_url($img_url, PHP_URL_PATH), PATHINFO_EXTENSION);
            if (!$ext) $ext = 'jpg';
            $filename = $post['slug'] . '.' . $ext;
            $savePath = $saveDir . $filename;

            $ch = curl_init($img_url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/119.0 Safari/537.36',
                CURLOPT_REFERER => 'https://movie-khmer.com',
            ]);
            $data = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($data && $httpcode == 200) {
                file_put_contents($savePath, $data);
                $img = 'images/' . $filename; // relative path for DB
            } else {
                echo "⚠️ Failed to download image for drama: {$post['title']['rendered']}\n";
            }
        } else {
            echo "⚠️ No featured image found for drama: {$post['title']['rendered']}\n";
        }
    }

    // ----- Get first category ID -----
    $category_id = null;
    if (!empty($post['categories'])) {
        $cat_wp_id = $post['categories'][0];
        $stmt = $pdo->prepare("SELECT id FROM categories WHERE wp_id = ?");
        $stmt->execute([$cat_wp_id]);
        $cat = $stmt->fetch();
        $category_id = $cat ? $cat['id'] : null;
    }

    // ----- Insert drama if new -----
    if (!$drama) {
        $stmt = $pdo->prepare("
        INSERT INTO dramas (wp_id, title, slug, featured_img, category_id, status)
        VALUES (?, ?, ?, ?, ?, 0)
    ");
        $stmt->execute([
            $post['id'],
            $post['title']['rendered'],
            $post['slug'],
            $img,
            $category_id
        ]);
        $dramaId = $pdo->lastInsertId();
        $addedNew = true;
    } else {
        $dramaId = $drama['id'];
    }

    // ----- Parse and insert episodes -----
    if (preg_match('/options\.player_list=\[\s*([\s\S]*?)\s*\];/', $post['content']['rendered'], $match)) {
        $jsonStr = '[' . $match[1] . ']';
        $jsonStr = preg_replace('/,\s*\]/', ']', $jsonStr); // remove trailing comma
        $episodes = json_decode($jsonStr, true);

        if ($episodes) {
            foreach ($episodes as $index => $ep) {
                $stmt = $pdo->prepare("SELECT id FROM episodes WHERE drama_id = ? AND ep_number = ?");
                $stmt->execute([$dramaId, $index + 1]);
                if (!$stmt->fetch()) {
                    $stmt = $pdo->prepare("INSERT INTO episodes (drama_id, ep_number, title, video_url) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$dramaId, $index + 1, $ep['title'], $ep['file']]);
                    $addedNew = true;
                }
            }
        }
    }
}

// ----- Final message -----
if ($addedNew) {
    echo "✅ Fetch complete — only new dramas & episodes inserted!\n";
} else {
    echo "ℹ️ No new dramas or episodes to update.\n";
}
