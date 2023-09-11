<?php
$user = ReadSingle($_SESSION['table'], $_SESSION['username'], 'UserName');
if ($user) :
    if ($user[0]['Privileges'] == '') {
        logOut();
    }
?>
    <div class="sidebar">
        <ul class="unstayled menu nav nav-pills flex-column" id="containermenus">
            <?php
            foreach (ReadLinks('links', $user[0]['Privileges']) as $link) : ?>
                <li class="rounded mt-1 list nav-item <?php echo basename($_SERVER['PHP_SELF']) == $link['link'] . '.php' ? 'active' : ''; ?>" id="menusitems">
                    <a href="<?= Escape($link['link']); ?>.php" class="text-decoration-none d-flex">
                        <span>
                            <i class='<?= Escape($link['icon']); ?>'></i>
                        </span>
                        <div class="ml-2">
                            <span class="text-capitalize">
                                <?= Escape(Capitalize($link['text'])); ?>
                            </span>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
        </ul>
    </div>