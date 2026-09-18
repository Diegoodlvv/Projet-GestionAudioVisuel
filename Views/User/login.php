<?php require_once 'header.php'; ?>
 
<div class="min-h-screen bg-slate-50 px-6 py-16">
    <div class="mx-auto max-w-md">
 
        <div class="mb-6 text-center">
            <p class="mb-2 text-sm font-semibold uppercase tracking-wider text-indigo-600">Content de vous revoir</p>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Connexion</h1>
        </div>
 
        <?php if (!empty($errors)): ?>
            <div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <ul class="list-inside list-disc space-y-1">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
 
        <form method="post" action="index.php?action=User/login"
              class="space-y-5 rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
 
            <div>
                <label for="email" class="mb-1.5 block text-sm font-medium text-slate-700">Email</label>
                <input type="email" id="email" name="email" required
                       value="<?= htmlspecialchars($email ?? '') ?>"
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">
            </div>
 
            <div>
                <label for="password" class="mb-1.5 block text-sm font-medium text-slate-700">Mot de passe</label>
                <input type="password" id="password" name="password" required
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">
            </div>
 
            <button type="submit"
                    class="mt-2 w-full rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                Se connecter
            </button>
 
            <p class="text-center text-sm text-slate-500">
                Pas encore de compte ?
                <a href="index.php?action=User/register" class="font-semibold text-indigo-600 hover:underline">S'inscrire</a>
            </p>
        </form>
    </div>
</div>
 
<?php require_once 'footer.php'; ?>
 