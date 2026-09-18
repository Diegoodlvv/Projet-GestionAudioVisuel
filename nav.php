<?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>

<nav class="sticky top-0 z-50 border-b border-slate-200 bg-white/80 backdrop-blur">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

        <a href="index.php?action=Media/library" class="text-lg font-bold tracking-tight text-slate-900">
            🎞️ Médiathèque
        </a>

        <div class="flex items-center gap-6 text-sm font-medium text-slate-600">
            <a href="index.php?action=Media/library#livres" id="nav-livres" class="transition hover:text-indigo-600">
                Livres
            </a>
            <a href="index.php?action=Media/library#films" id="nav-films" class="transition hover:text-rose-600">
                Films
            </a>
            <a href="index.php?action=Media/library#albums" id="nav-albums" class="transition hover:text-emerald-600">
                Albums
            </a>

            <?php if (isset($_SESSION['user_id'])): ?>
                <span class="hidden text-slate-300 sm:inline">|</span>
                <span class="hidden text-slate-500 sm:inline">
                    <?= htmlspecialchars($_SESSION['user_email']) ?>
                </span>
                <a href="index.php?action=User/logout" id="nav-logout"
                   class="rounded-lg bg-slate-100 px-3 py-1.5 text-slate-700 transition hover:bg-slate-200">
                    Déconnexion
                </a>
            <?php else: ?>
                <a href="index.php?action=User/login" id="nav-login" class="transition hover:text-indigo-600">
                    Connexion
                </a>
                <a href="index.php?action=User/register" id="nav-register"
                   class="rounded-lg bg-indigo-600 px-3 py-1.5 text-white transition hover:bg-indigo-700">
                    Inscription
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>