<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #001f3f;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .container {
        width: 45%;
        background: linear-gradient(135deg, #004080, #002244);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        text-align: center;
        color: white;
    }
    h3 {
        font-size: 26px;
        margin-bottom: 20px;
    }
    label {
        font-weight: 600;
        display: block;
        margin-top: 15px;
        text-align: left;
        font-size: 14px;
    }
    input[type="time"], input[type="number"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #007bff;
        border-radius: 8px;
        font-size: 16px;
        background: white;
        color: black;
    }
    .days-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
        justify-content: center;
    }
    .days-container label {
        background: #007bff;
        color: white;
        padding: 10px 15px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        transition: 0.3s;
    }
    .days-container input[type="checkbox"] {
        display: none;
    }
    .days-container input[type="checkbox"]:checked + label {
        background: #28a745;
        transform: scale(1.1);
    }
    .btn {
        width: 100%;
        background: #ffcc00;
        color: black;
        padding: 12px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        margin-top: 25px;
        font-size: 18px;
        font-weight: bold;
        transition: 0.3s;
    }
    .btn:hover {
        background: #ff9900;
        transform: scale(1.05);
    }
</style>

<div class="container">
    <h3>Pengaturan Jam Kerja</h3>
    <label for="jam-masuk">Jam Masuk</label>
    <input type="time" id="jam-masuk">

    <label for="jam-keluar">Jam Keluar</label>
    <input type="time" id="jam-keluar">

    <label>Hari Kerja</label>
    <div class="days-container">
        <input type="checkbox" id="senin"><label for="senin">Senin</label>
        <input type="checkbox" id="selasa"><label for="selasa">Selasa</label>
        <input type="checkbox" id="rabu"><label for="rabu">Rabu</label>
        <input type="checkbox" id="kamis"><label for="kamis">Kamis</label>
        <input type="checkbox" id="jumat"><label for="jumat">Jumat</label>
        <input type="checkbox" id="sabtu"><label for="sabtu">Sabtu</label>
    </div>

    <label for="max-peserta">Jumlah Maksimal Peserta Magang</label>
    <input type="number" id="max-peserta" min="1">

    <button class="btn">Tambah Jadwal</button>
</div>
