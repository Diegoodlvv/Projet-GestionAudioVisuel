<?php

require_once 'header.php';

?>

<div class="min-h-screen bg-slate-50 px-6 py-16">
    <div class="mx-auto max-w-lg">

        <div class="mb-6 text-center">
            <p class="mb-2 text-sm font-semibold uppercase tracking-wider text-indigo-600">
                Livre
            </p>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                <?= isset($book) ? 'Modifier ' . htmlspecialchars($bookInfos['title']) : 'Ajouter un livre' ?>
            </h1>
        </div>

        <form method="post"
              class="space-y-5 rounded-3xl border border-slate-200 bg-white p-8 shadow-sm"
              action="<?= isset($book)
                    ? 'index.php?action=Book/updateBook/' . $bookInfos['id']
                    : 'index.php?action=Book/createBook' ?>">

            <div>
                <label for="title" class="mb-1.5 block text-sm font-medium text-slate-700">Titre</label>
                <input type="text" id="title" name="title" required
                       value="<?= isset($book) ? htmlspecialchars($bookInfos['title']) : '' ?>"
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">
            </div>

            <div>
                <label for="author" class="mb-1.5 block text-sm font-medium text-slate-700">Auteur</label>
                <input type="text" id="author" name="author" required
                       value="<?= isset($book) ? htmlspecialchars($bookInfos['author']) : '' ?>"
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">
            </div>

            <div>
                <label for="pageNumber" class="mb-1.5 block text-sm font-medium text-slate-700">Nombre de pages</label>
                <input type="number" id="pageNumber" name="pageNumber" required min="1"
                       value="<?= isset($book) ? htmlspecialchars($book['pageNumber']) : '' ?>"
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">
            </div>

            <label class="flex items-center gap-2.5 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                <input type="checkbox" id="available" name="available"
                       <?= isset($book) && $bookInfos['available'] ? 'checked' : '' ?>
                       class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                <span class="text-sm font-medium text-slate-700">Disponible à l'emprunt</span>
            </label>

            <button type="submit"
                    class="mt-2 w-full rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                <?= isset($book) ? 'Modifier le livre' : 'Ajouter le livre' ?>
            </button>

            <a href="index.php?action=Media/library"
               class="block text-center text-sm font-medium text-slate-500 transition hover:text-slate-700">
                ← Retour à la médiathèque
            </a>
        </form>
    </div>
</div>

<?php

require_once 'footer.php';