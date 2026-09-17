<?php

require_once 'header.php';

?>

<div class="min-h-screen bg-slate-50 px-6 py-16">
    <div class="mx-auto max-w-lg">

        <div class="mb-6 text-center">
            <p class="mb-2 text-sm font-semibold uppercase tracking-wider text-rose-600">
                Film
            </p>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                <?= isset($movie) ? 'Modifier ' . htmlspecialchars($movieInfos['title']) : 'Ajouter un film' ?>
            </h1>
        </div>

        <form method="post"
              class="space-y-5 rounded-3xl border border-slate-200 bg-white p-8 shadow-sm"
              action="<?= isset($movie)
                    ? 'index.php?action=Movie/updateMovie/' . $movieInfos['id']
                    : 'index.php?action=Movie/createMovie' ?>">

            <div>
                <label for="title" class="mb-1.5 block text-sm font-medium text-slate-700">Titre</label>
                <input type="text" id="title" name="title" required
                       value="<?= isset($movie) ? htmlspecialchars($movieInfos['title']) : '' ?>"
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-rose-400 focus:bg-white focus:ring-2 focus:ring-rose-100">
            </div>

            <div>
                <label for="author" class="mb-1.5 block text-sm font-medium text-slate-700">Réalisateur</label>
                <input type="text" id="author" name="author" required
                       value="<?= isset($movie) ? htmlspecialchars($movieInfos['author']) : '' ?>"
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-rose-400 focus:bg-white focus:ring-2 focus:ring-rose-100">
            </div>

            <div>
                <label for="duration" class="mb-1.5 block text-sm font-medium text-slate-700">Durée (minutes)</label>
                <input type="number" id="duration" name="duration" required min="1" step="any"
                       value="<?= isset($movie) ? htmlspecialchars($movie['duration']) : '' ?>"
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-rose-400 focus:bg-white focus:ring-2 focus:ring-rose-100">
            </div>

            <div>
                <label for="genre" class="mb-1.5 block text-sm font-medium text-slate-700">Genre</label>
                <select id="genre" name="genre"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-rose-400 focus:bg-white focus:ring-2 focus:ring-rose-100">
                    <?php foreach (EnumMovie::cases() as $genre): ?>
                        <option value="<?= $genre->value ?>"
                            <?= isset($movie) && $movie['genre'] === $genre->value ? 'selected' : '' ?>>
                            <?= $genre->name ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <label class="flex items-center gap-2.5 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                <input type="checkbox" id="available" name="available"
                       <?= isset($movie) && $movieInfos['available'] ? 'checked' : '' ?>
                       class="h-4 w-4 rounded border-slate-300 text-rose-600 focus:ring-rose-500">
                <span class="text-sm font-medium text-slate-700">Disponible à l'emprunt</span>
            </label>

            <button type="submit"
                    class="mt-2 w-full rounded-xl bg-rose-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-rose-700">
                <?= isset($movie) ? 'Modifier le film' : 'Ajouter le film' ?>
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
