<?php
session_start();
require_once '../lib/db.php';
include '../lib/drama_lib.php';
$dramaObj = new Drama();
$limit = 10;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

$totalDramas = $dramaObj->countAll();
$totalPages = ceil($totalDramas / $limit);

$dramas = $dramaObj->getAllPaginated($limit, $offset);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drama Admin</title>
 <link rel="stylesheet" href="/src/output.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Drama Management</h1>

        <!-- Search Box -->
        <div class="mb-4">
            <input type="text" id="searchInput"
                class="w-full md:w-1/3 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Search by title...">
        </div>

        <!-- Table -->
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table id="dramaTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Featured Image</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($dramas as $d): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2"><?= $d['id'] ?></td>
                            <td class="px-4 py-2 drama-title"><?= htmlspecialchars($d['title']) ?></td>
                            <td class="px-4 py-2">
                                <?php if ($d['featured_img']): ?>
                                    <img src="/<?= htmlspecialchars($d['featured_img']) ?>" class="w-20 h-20 object-cover rounded-md border" loading="lazy">
                                <?php else: ?>
                                    <span class="text-gray-400">No image</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <button onclick="toggleStatus(<?= $d['id'] ?>, this)"
                                    class="px-3 py-1 rounded-md text-sm <?= $d['status'] ? 'bg-black text-white' : 'bg-green-600 text-white' ?>">
                                    <?= $d['status'] ? 'Inactive' : 'Active' ?>
                                </button>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <button onclick='openModal(<?= json_encode($d) ?>)'
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-sm">Edit Image</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <!-- Responsive Pagination -->
        <div class="mt-6 flex flex-wrap justify-center items-center gap-2 text-sm">
            <?php
            $visibleRange = 1; // number of pages before and after current
            $start = max(1, $page - $visibleRange);
            $end = min($totalPages, $page + $visibleRange);
            ?>

            <!-- First + Prev -->
            <?php if ($page > 1): ?>
                <a href="?page=1" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 transition">First</a>
                <a href="?page=<?= $page - 1 ?>" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 transition">Prev</a>
            <?php endif; ?>

            <!-- Ellipsis before -->
            <?php if ($start > 2): ?>
                <a href="?page=1" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 transition">1</a>
                <span class="px-2 py-1 text-gray-500 select-none">...</span>
            <?php elseif ($start == 2): ?>
                <a href="?page=1" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 transition">1</a>
            <?php endif; ?>

            <!-- Main Pages -->
            <?php for ($p = $start; $p <= $end; $p++): ?>
                <a href="?page=<?= $p ?>"
                    class="px-3 py-1 rounded transition <?= $p == $page ? 'bg-blue-600 text-white font-medium' : 'bg-gray-200 hover:bg-gray-300' ?>">
                    <?= $p ?>
                </a>
            <?php endfor; ?>

            <!-- Ellipsis after -->
            <?php if ($end < $totalPages - 1): ?>
                <span class="px-2 py-1 text-gray-500 select-none">...</span>
                <a href="?page=<?= $totalPages ?>" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 transition"><?= $totalPages ?></a>
            <?php elseif ($end == $totalPages - 1): ?>
                <a href="?page=<?= $totalPages ?>" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 transition"><?= $totalPages ?></a>
            <?php endif; ?>

            <!-- Next + Last -->
            <?php if ($page < $totalPages): ?>
                <a href="?page=<?= $page + 1 ?>" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 transition">Next</a>
                <a href="?page=<?= $totalPages ?>" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 transition">Last</a>
            <?php endif; ?>
        </div>




    </div>

    <!-- Modal for updating image -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg max-w-md w-full relative">
            <span class="absolute top-2 right-3 text-gray-500 cursor-pointer text-2xl font-bold" onclick="closeModal()">&times;</span>
            <h2 class="text-xl font-bold mb-4">Update Featured Image</h2>
            <form id="imageForm" method="POST" enctype="multipart/form-data" action="update_image">
                <input type="hidden" name="drama_id" id="drama_id">
                <div class="mb-4">
                    <label class="block font-medium mb-1">Current Image</label>
                    <img id="currentImage" src="" class="w-32 h-32 object-cover rounded-md border mb-2">
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-1">Select New Image</label>
                    <input type="file" name="featured_img" id="newImageInput" required>
                    <div class="mt-2">
                        <label class="block font-medium mb-1">Preview</label>
                        <img id="newImagePreview" src="" class="w-32 h-32 object-cover rounded-md border hidden">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">Save</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                const query = $(this).val().trim();

                if (query.length === 0) {
                    location.reload();
                    return;
                }

                $.getJSON('search_dramas.php', {
                    q: query
                }, function(data) {
                    const tbody = $('#dramaTable tbody');
                    tbody.empty();

                    if (data.length === 0) {
                        tbody.append(`
                    <tr><td colspan="5" class="text-center py-4 text-gray-500">No results found</td></tr>
                `);
                        return;
                    }

                    data.forEach(d => {
                        const statusClass = d.status == 1 ? 'bg-black text-white' : 'bg-green-600 text-white';
                        const statusText = d.status == 1 ? 'Inactive' : 'Active';
                        const img = d.featured_img ?
                            `<img src="/${d.featured_img}" class="w-20 h-20 object-cover rounded-md border">` :
                            `<span class="text-gray-400">No image</span>`;

                        tbody.append(`
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">${d.id}</td>
                        <td class="px-4 py-2 drama-title">${d.title}</td>
                        <td class="px-4 py-2">${img}</td>
                        <td class="px-4 py-2 text-center">
                            <button onclick="toggleStatus(${d.id}, this)"
                                class="px-3 py-1 rounded-md text-sm ${statusClass}">
                                ${statusText}
                            </button>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <button onclick='openModal(${JSON.stringify(d)})'
                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-sm">Edit Image</button>
                        </td>
                    </tr>
                `);
                    });
                });
            });
        });
    </script>

    <script>
        // Modal functions
        function openModal(drama) {
            document.getElementById('imageModal').style.display = 'flex';
            document.getElementById('drama_id').value = drama.id;
            document.getElementById('currentImage').src = drama.featured_img ? '/' + drama.featured_img : '';
            document.getElementById('newImagePreview').classList.add('hidden');
            document.getElementById('newImagePreview').src = '';
        }

        function closeModal() {
            document.getElementById('imageModal').style.display = 'none';
        }

        // Preview selected image
        document.getElementById('newImageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    const preview = document.getElementById('newImagePreview');
                    preview.src = ev.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // Toggle status via AJAX
      function toggleStatus(dramaId, btn) {
    $.post('update_status', { id: dramaId }, function(res) {
        if (res.success) {
            // Remember: 0 = Active, 1 = Inactive
            if (res.status == 0) {
                btn.classList.remove('bg-gray-400');
                btn.classList.add('bg-green-600');
                btn.textContent = 'Active';
            } else {
                btn.classList.remove('bg-green-600');
                btn.classList.add('bg-gray-400');
                btn.textContent = 'Inactive';
            }
        } else {
            alert('Failed to update status');
        }
    }, 'json');
}

    </script>

</body>

</html>