<?php

require_once 'header.php';

?>

<div class="min-h-screen bg-slate-50 px-6 py-16">
    <div class="mx-auto max-w-lg">

        <div class="mb-6 text-center">
            <p class="mb-2 text-sm font-semibold uppercase tracking-wider text-emerald-600">
                Album
            </p>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                <?= isset($album) ? 'Modifier ' . htmlspecialchars($albumInfos['title']) : "Ajouter un album" ?>
            </h1>
        </div>

        <form method="post"
              class="space-y-5 rounded-3xl border border-slate-200 bg-white p-8 shadow-sm"
              action="<?= isset($album)
                    ? 'index.php?action=Album/updateAlbum/' . $albumInfos['id']
                    : 'index.php?action=Album/createAlbum' ?>">

            <div>
                <label for="title" class="mb-1.5 block text-sm font-medium text-slate-700">Titre</label>
                <input type="text" id="title" name="title" required
                       value="<?= isset($album) ? htmlspecialchars($albumInfos['title']) : '' ?>"
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-2 focus:ring-emerald-100">
            </div>

            <div>
                <label for="author" class="mb-1.5 block text-sm font-medium text-slate-700">Artiste</label>
                <input type="text" id="author" name="author" required
                       value="<?= isset($album) ? htmlspecialchars($albumInfos['author']) : '' ?>"
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-2 focus:ring-emerald-100">
            </div>

            <div>
                <label for="trackNumber" class="mb-1.5 block text-sm font-medium text-slate-700">Nombre de pistes</label>
                <input type="number" id="trackNumber" name="trackNumber" required min="1"
                       value="<?= isset($album) ? htmlspecialchars($album['trackNumber']) : '' ?>"
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-2 focus:ring-emerald-100">
            </div>

            <div>
                <label for="editor" class="mb-1.5 block text-sm font-medium text-slate-700">Éditeur</label>
                <input type="text" id="editor" name="editor" required
                       value="<?= isset($album) ? htmlspecialchars($album['editor']) : '' ?>"
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-400 focus:bg-white focus:ring-2 focus:ring-emerald-100">
            </div>

            <label class="flex items-center gap-2.5 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                <input type="checkbox" id="available" name="available"
                       <?= isset($album) && $albumInfos['available'] ? 'checked' : '' ?>
                       class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                <span class="text-sm font-medium text-slate-700">Disponible à l'emprunt</span>
            </label>

            <button type="submit"
                    class="mt-2 w-full rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                <?= isset($album) ? 'Modifier l\'album' : 'Ajouter l\'album' ?>
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
