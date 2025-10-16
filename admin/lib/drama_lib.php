
<?php
require_once 'db.php';
class Drama
{
    public $db;

    public function __construct()
    {
        $this->db = dbConn();
    }
    public function getAllPaginated($limit, $offset)
    {
        $stmt = $this->db->prepare("
        SELECT * FROM dramas 
        ORDER BY created_at DESC 
        LIMIT :limit OFFSET :offset
    ");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLatest($limit = 12)
    {
        $stmt = $this->db->prepare("
        SELECT * FROM dramas 
        WHERE status = 0
        ORDER BY created_at DESC 
        LIMIT :limit
    ");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getAllStatus0($limit = 9)
    {
        $stmt = $this->db->prepare("
        SELECT d.*, c.name AS category_name, c.slug AS category_slug
        FROM dramas d
        LEFT JOIN categories c ON d.category_id = c.id
        WHERE d.status = 0
        ORDER BY d.created_at DESC
        LIMIT :limit
    ");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    public function getAll()
    {
        $stmt = $this->db->query("
        SELECT d.*, c.name AS category_name, c.slug AS category_slug
        FROM dramas d
        LEFT JOIN categories c ON d.category_id = c.id
        ORDER BY d.created_at DESC
    ");
        return $stmt->fetchAll();
    }


    public function getByCategorySlug($categorySlug, $limit = null, $offset = 0)
    {
        $sql = "
        SELECT d.*, c.name AS category_name, c.slug AS category_slug
        FROM dramas d
        INNER JOIN categories c ON d.category_id = c.id
        WHERE c.slug = :slug
          AND d.status = 0
        ORDER BY d.created_at DESC
    ";

        if ($limit !== null) {
            $sql .= " LIMIT :limit OFFSET :offset";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':slug', $categorySlug, PDO::PARAM_STR);

        if ($limit !== null) {
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // Get episodes for a drama
    public function getEpisodes($dramaId)
    {
        $stmt = $this->db->prepare("SELECT * FROM episodes WHERE drama_id = ? ORDER BY ep_number ASC");
        $stmt->execute([$dramaId]);
        return $stmt->fetchAll();
    }

    public function getBySlug($slug)
    {
        $stmt = $this->db->prepare("SELECT * FROM dramas WHERE slug = ?");
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }

  


    public function insert($wp_id, $name, $slug, $featured_img = null, $category_id = null)
    {
        $stmt = $this->db->prepare("INSERT INTO dramas (wp_id, name, slug, featured_img, category_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$wp_id, $name, $slug, $featured_img, $category_id]);
        return $this->db->lastInsertId();
    }


    public function updateImage($id, $imgPath)
    {
        $stmt = $this->db->prepare("UPDATE dramas SET featured_img = ? WHERE id = ?");
        return $stmt->execute([$imgPath, $id]);
    }

    public function exists($wp_id)
    {
        $stmt = $this->db->prepare("SELECT id FROM dramas WHERE wp_id = ?");
        $stmt->execute([$wp_id]);
        return $stmt->fetch();
    }

    public function getPaginated($offset, $limit)
    {
        $stmt = $this->db->prepare("
        SELECT * FROM dramas 
        ORDER BY created_at DESC 
        LIMIT :limit OFFSET :offset
    ");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function countAll()
    {
        return $this->db->query("SELECT COUNT(*) FROM dramas")->fetchColumn();
    }

    public function getByCategorySlugPaginated($slug, $offset, $limit)
    {
        $stmt = $this->db->prepare("
        SELECT d.* 
        FROM dramas d
        INNER JOIN categories c ON d.category_id = c.id
        WHERE c.slug = :slug
        ORDER BY d.created_at DESC
        LIMIT :limit OFFSET :offset
    ");
        $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countByCategorySlug($slug)
    {
        $stmt = $this->db->prepare("
        SELECT COUNT(*) 
        FROM dramas d
        INNER JOIN categories c ON d.category_id = c.id
        WHERE c.slug = ?
    ");
        $stmt->execute([$slug]);
        return $stmt->fetchColumn();
    }


    public function getRelated($currentDramaId, $limit = 20)
    {
        // Fetch the category of current drama
        $stmt = $this->db->prepare("SELECT category_id FROM dramas WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $currentDramaId]);
        $categoryId = $stmt->fetchColumn();

        if (!$categoryId) return [];

        // Fetch related dramas in same category (active only), newest first
        $stmt = $this->db->prepare("
        SELECT * FROM dramas 
        WHERE category_id = :category_id 
          AND id != :current_id 
          AND status = 0
        ORDER BY created_at DESC
        LIMIT :limit
    ");

        // Bind parameters
        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':current_id', $currentDramaId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
