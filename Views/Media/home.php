<?php 

require_once 'header.php';
require_once 'Controllers/BookController.php';

?>

<div class="min-h-screen bg-slate-50 px-6 py-12">
    <div class="mx-auto max-w-7xl">
        <div class="mb-10">
            <p class="mb-2 text-sm font-semibold uppercase tracking-wider text-indigo-600">
                Médiathèque
            </p>
            <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                Tous nos médias
            </h1>
            <p class="mt-2 text-slate-500">
                Découvrez nos livres, films et albums
            </p>
        </div>

         <form method="GET" action="" class="flex h-[50px] max-w-[1500px] mx-auto gap-2 px-4 my-12">
            <input type="text" name="text" value="<?= $search ?>" placeholder="Rechercher un livre..." class="flex-1 px-4 rounded-lg border border-gray-300" >
            <input type="submit" value="Rechercher" class="px-6 rounded-lg bg-blue-600 text-white cursor-pointer hover:bg-blue-700" >
        </form>


        <div class="flex flex-col gap-6">

            <section id="medias" class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                <div class="items-center border-b border-slate-100 bg-gradient-to-br from-indigo-500 to-violet-600"> 
                    <div class="p-6">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-white/20 text-2xl backdrop-blur">
                            📚
                        </div>

                        <h2 class="text-2xl font-bold text-white">
                            Médias
                        </h2>
                        <p class="mt-1 text-sm text-indigo-100">
                            Découvrez notre collection de médias
                        </p>
                    </div>
                </div>

                <div class="space-y-4 p-5">
                    <?php foreach ($mediasFiltered as $media): ?>
                        <a href="index.php?action=Media/library" class="block">
                            <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4 transition hover:border-indigo-200 hover:bg-indigo-50/50">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <h3 class="font-semibold text-slate-900">
                                            <?= htmlspecialchars($media['title']) ?>
                                        </h3>
                                        <p class="mt-1 text-sm text-slate-500">
                                            <?= htmlspecialchars($media['author']) ?>
                                        </p>
                                    </div>

                                    <?php if ($media['available']): ?>
                                        <span class="shrink-0 rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-700">
                                            Disponible
                                        </span>
                                    <?php else: ?>
                                        <span class="shrink-0 rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700">
                                            Indisponible
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>

            <div id="pagination" class="flex justify-center gap-2">
                <?php if ($pages < 4) : ?>
                    <?php for ($i = 1; $i <= $pages; $i++): ?>
                        <a href="index.php?action=Media/home&page=<?= $i ?>"
                        class="rounded-lg px-3 py-1.5 text-sm font-medium transition <?= $i == $currentPage ? 'bg-indigo-600 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                <?php else : ?>
                    <?php if ($currentPage - 1 === 0 ) : ?>
                        <a href="index.php?action=Media/home&page=<?= $currentPage ?>" class="rounded-lg px-3 py-1.5 text-sm font-medium transition bg-indigo-600 text-white">
                            <?= $currentPage ?>
                        </a>
                        <a href="index.php?action=Media/home&page=<?= $currentPage + 1 ?>" class="rounded-lg px-3 py-1.5 text-sm font-medium transition bg-slate-100 text-slate-700 hover:bg-slate-200">
                            <?= $currentPage + 1?>
                        </a>
                    <?php elseif($currentPage == $pages) : ?>
                        <a href="index.php?action=Media/home&page=<?= $currentPage - 1 ?>" class="rounded-lg px-3 py-1.5 text-sm font-medium transition bg-slate-100 text-slate-700 hover:bg-slate-200">
                            <?= $currentPage - 1 ?>
                        </a>
                        <a href="index.php?action=Media/home&page=<?= $currentPage ?>" class="rounded-lg px-3 py-1.5 text-sm font-medium transition bg-indigo-600 text-white">
                            <?= $currentPage ?>
                        </a>
                    <?php elseif($currentPage - 1 > 0 && $currentPage < $pages) : ?>
                        <a href="index.php?action=Media/home&page=<?= $currentPage - 1 ?>" class="rounded-lg px-3 py-1.5 text-sm font-medium transition bg-slate-100 text-slate-700 hover:bg-slate-200">
                            <?= $currentPage - 1 ?>
                        </a>
                        <a href="index.php?action=Media/home&page=<?= $currentPage ?>" class="rounded-lg px-3 py-1.5 text-sm font-medium transition bg-indigo-600 text-white">
                            <?= $currentPage ?>
                        </a>
                        <a href="index.php?action=Media/home&page=<?= $currentPage + 1 ?>" class="rounded-lg px-3 py-1.5 text-sm font-medium transition bg-slate-100 text-slate-700 hover:bg-slate-200">
                            <?= $currentPage + 1?>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>

                <div class="rounded-lg px-6 py-1.5 ml-5 text-sm font-medium transition bg-indigo-600 text-white">
                    <?= $pages ?> pages
                </div>
            </div>
        </div>
    </div>
</div>


<?php 

require_once 'footer.php';