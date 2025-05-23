<!DOCTYPE html>
<html>

<head>
    <title>Edit Data Average</title>
</head>

<body>
    <h1>Edit Data Average</h1>
    <form action="/average/update/<?= $average['id'] ?>" method="post">
        <?= csrf_field() ?>
        <label>PTKP Status:</label><br>
        <input type="text" name="ptkp_status" value="<?= $average['ptkp_status'] ?>" required><br><br>

        <label>Bruto Min:</label><br>
        <input type="number" name="bruto_min" step="0.01" value="<?= $average['bruto_min'] ?>" required><br><br>

        <label>Bruto Max:</label><br>
        <input type="number" name="bruto_max" step="0.01" value="<?= $average['bruto_max'] ?>" required><br><br>

        <label>Tarik %:</label><br>
        <input type="number" name="tarik_pct" step="0.01" value="<?= $average['tarik_pct'] ?>" required><br><br>

        <label>Golongan:</label><br>
        <input type="text" name="golongan" value="<?= $average['golongan'] ?>" required><br><br>

        <button type="submit">Update</button>
    </form>
    <a href="/average">Kembali</a>
</body>

</html>
