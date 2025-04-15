<?php
/**
 * View file for category list with pagination
 */
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Categories</h3>
                    <div class="card-tools">
                        <a href="/category/add" class="btn btn-primary btn-sm">Add New Category</a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (empty($list)): ?>
                        <div class="alert alert-info">No categories found</div>
                    <?php else: ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($list as $item): ?>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <td><?= $item['name'] ?></td>
                                    <td>
                                        <a href="/category/update/<?= $item['id'] ?>" class="btn btn-info btn-sm">Edit</a>
                                        <a href="/category/delete/<?= $item['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
                <div class="card-footer clearfix">
                    <?php if ($pageCount > 1): ?>
                        <ul class="pagination pagination-sm m-0 float-right">
                            <?php
                            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

                            // Previous page link
                            if ($currentPage > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $currentPage - 1 ?>">&laquo;</a>
                                </li>
                            <?php endif; ?>

                            <?php
                            // Calculate which page numbers to show
                            $startPage = max(1, $currentPage - 2);
                            $endPage = min($pageCount, $currentPage + 2);

                            // Always show first page link
                            if ($startPage > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=1">1</a>
                                </li>
                                <?php if ($startPage > 2): ?>
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                                <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php
                            // Always show last page link
                            if ($endPage < $pageCount): ?>
                                <?php if ($endPage < $pageCount - 1): ?>
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                <?php endif; ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $pageCount ?>"><?= $pageCount ?></a>
                                </li>
                            <?php endif; ?>

                            <?php
                            // Next page link
                            if ($currentPage < $pageCount): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $currentPage + 1 ?>">&raquo;</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>