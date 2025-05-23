<?php
$menuItems = [
    ['label' => 'Home', 'href' => '#section_1'],
    ['label' => 'About', 'href' => '#section_2'],
    ['label' => 'Services', 'href' => '#section_3'],
    ['label' => 'Projects', 'href' => '#section_4'],
    ['label' => 'Contact', 'href' => '#section_5'],
]
?>

<nav class="navbar navbar-expand-lg">
    <div class="container">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a href="index.php" class="navbar-brand mx-auto mx-lg-0">First</a>

        <div class="d-flex align-items-center d-lg-none">
            <i class="navbar-icon bi-telephone-plus me-3"></i>
            <a class="custom-btn btn" href="#section_5">120-240-9600</a>
        </div>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-lg-5">
                <?php foreach ($menuItems as $item): ?>
                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="<?= htmlspecialchars($item['href']) ?>">
                            <?= htmlspecialchars($item['label']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="d-lg-flex align-items-center d-none ms-auto">
                <i class="navbar-icon bi-telephone-plus me-3"></i>
                <a class="custom-btn btn" href="#section_5">120-240-9600</a>
            </div>
        </div>
    </div>
</nav>