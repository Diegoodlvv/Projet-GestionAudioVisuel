<?php 

require_once 'header.php';
require_once 'Controllers/BookController.php';

?>

<div class="min-h-screen bg-slate-50 px-6 py-12">
    <div class="mx-auto max-w-7xl">
        <div class="mb-10">
            <p class="mb-2 text-sm font-semibold uppercase tracking-wider text-indigo-600">
                Bibliothèque
            </p>
            <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                Nos collections
            </h1>
            <p class="mt-2 text-slate-500">
                Découvrez nos livres, films et albums disponibles à l'emprunt.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                <div class="flex items-center justify-between  border-b border-slate-100 bg-gradient-to-br from-indigo-500 to-violet-600"> 
                    <div class="p-6">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-white/20 text-2xl backdrop-blur">
                            📚
                        </div>

                        <h2 class="text-2xl font-bold text-white">
                            Livres
                        </h2>
                        <p class="mt-1 text-sm text-indigo-100">
                            Découvrez notre collection de livres
                        </p>
                    </div>
                    <div class="p-6">
                        <a href="index.php?action=Book/createBook" class="mt-4 flex w-full items-center justify-center rounded-xl bg-indigo-600 px-4 py-2.5  text-sm font-semibold text-white transition hover:bg-indigo-700">
                            Ajouter un livre
                        </a>
                    </div>
                </div>

                <div class="space-y-4 p-5">
                    <?php foreach ($books as $book): ?>
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4 transition hover:border-indigo-200 hover:bg-indigo-50/50">

                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h3 class="font-semibold text-slate-900">
                                        <?= htmlspecialchars($book['title']) ?>
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        <?= htmlspecialchars($book['author']) ?>
                                    </p>
                                </div>

                                <?php if ($book['available']): ?>
                                    <span class="shrink-0 rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-700">
                                        Disponible
                                    </span>
                                <?php else: ?>
                                    <span class="shrink-0 rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700">
                                        Indisponible
                                    </span>
                                <?php endif; ?>
                            </div>

                            <?php if ($book['available']): ?>
                                <a
                                    href="index.php?action=emprunter&id=<?= $book['id'] ?>"
                                    class="mt-4 flex w-full items-center justify-center rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
                                >
                                    Emprunter
                                </a>
                            <?php else: ?>
                                <button
                                    disabled
                                    class="mt-4 w-full cursor-not-allowed rounded-xl bg-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-400"
                                >
                                    Indisponible
                                </button>
                            <?php endif; ?>

                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                <div class="border-b border-slate-100 bg-gradient-to-br from-rose-500 to-orange-500 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-white/20 text-2xl backdrop-blur">
                        🎬
                    </div>

                    <h2 class="text-2xl font-bold text-white">
                        Films
                    </h2>
                    <p class="mt-1 text-sm text-rose-100">
                        Retrouvez vos films préférés
                    </p>
                </div>

                <div class="space-y-4 p-5">
                    <?php foreach ($movies as $movie): ?>
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4 transition hover:border-rose-200 hover:bg-rose-50/50">

                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h3 class="font-semibold text-slate-900">
                                        <?= htmlspecialchars($movie['title']) ?>
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        <?= htmlspecialchars($movie['author']) ?>
                                    </p>
                                </div>

                                <?php if ($movie['available']): ?>
                                    <span class="shrink-0 rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-700">
                                        Disponible
                                    </span>
                                <?php else: ?>
                                    <span class="shrink-0 rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700">
                                        Indisponible
                                    </span>
                                <?php endif; ?>
                            </div>

                            <?php if ($movie['available']): ?>
                                <a
                                    href="index.php?action=emprunter&id=<?= $movie['id'] ?>"
                                    class="mt-4 flex w-full items-center justify-center rounded-xl bg-rose-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-rose-700"
                                >
                                    Emprunter
                                </a>
                            <?php else: ?>
                                <button
                                    disabled
                                    class="mt-4 w-full cursor-not-allowed rounded-xl bg-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-400"
                                >
                                    Indisponible
                                </button>
                            <?php endif; ?>

                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                <div class="border-b border-slate-100 bg-gradient-to-br from-emerald-500 to-teal-500 p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-white/20 text-2xl backdrop-blur">
                        🎵
                    </div>

                    <h2 class="text-2xl font-bold text-white">
                        Albums
                    </h2>
                    <p class="mt-1 text-sm text-emerald-100">
                        Écoutez notre sélection musicale
                    </p>
                </div>

                <div class="space-y-4 p-5">
                    <?php foreach ($albums as $album): ?>
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4 transition hover:border-emerald-200 hover:bg-emerald-50/50">

                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h3 class="font-semibold text-slate-900">
                                        <?= htmlspecialchars($album['title']) ?>
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        <?= htmlspecialchars($album['author']) ?>
                                    </p>
                                </div>

                                <?php if ($album['available']): ?>
                                    <span class="shrink-0 rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-700">
                                        Disponible
                                    </span>
                                <?php else: ?>
                                    <span class="shrink-0 rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700">
                                        Indisponible
                                    </span>
                                <?php endif; ?>
                            </div>

                            <?php if ($album['available']): ?>
                                <a
                                    href="index.php?action=emprunter&id=<?= $album['id'] ?>"
                                    class="mt-4 flex w-full items-center justify-center rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700"
                                >
                                    Emprunter
                                </a>
                            <?php else: ?>
                                <button
                                    disabled
                                    class="mt-4 w-full cursor-not-allowed rounded-xl bg-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-400"
                                >
                                    Indisponible
                                </button>
                            <?php endif; ?>

                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

        </div>
    </div>
</div>


<?php 

require_once 'footer.php';