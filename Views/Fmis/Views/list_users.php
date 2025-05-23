<?= $this->extend('base_view') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h2>Λίστα Χρηστών</h2>
    
    <?php if (session()->has('message')): ?>
        <div class="alert alert-success">
            <?= session('message') ?>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Ονοματεπώνυμο</th>
                    <th>Ομάδες</th>
                    <th>Ενέργειες</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->username ?></td>
                    <td><?= implode(', ', $user->getGroups()) ?></td>
                    <td>
                        <a href="<?= base_url('fmis/assign-group/' . $user->id) ?>" class="btn btn-primary btn-sm">
                            Ανάθεση Ομάδας
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?> 