<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Kamar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded shadow-md w-full max-w-xl">
        <h1 class="text-2xl font-bold mb-6 text-center">Booking Kamar</h1>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5 text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('booking.store') }}">
            @csrf

            <div class="mb-4">
                <p>Jumlah Unit: {{ $roomunits->count() }}</p>
                <input type="hidden" name="room_id" value="{{ $selectedRoom->id }}">
                <label for="room_unit_id" class="block font-medium mb-1">Pilih Kamar (Unit)</label>
                <select name="room_unit_id" id="room_unit_id" class="form-select w-full border border-gray-300 rounded px-3 py-2">
                    <option value="">Pilih Nomor Unit</option>
                    @foreach ($roomunits as $unit)
                    <option value="{{ $unit->id }}">
                        {{ $unit->unit_number }} ({{ $unit->room->name }})
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="start_date" class="block font-medium mb-1">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date" required class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label for="end_date" class="block font-medium mb-1">Tanggal Selesai</label>
                <input type="date" name="end_date" id="end_date" required class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label for="phone" class="block font-medium mb-1">Nomor Telepon</label>
                <input type="text" name="phone" id="end_date" required class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label for="address" class="block font-medium mb-1">Alamat</label>
                <textarea name="address" id="address" class="w-full border border-gray-300 rounded px-3 py-2" rows="3"></textarea>
            </div>

            <div class="mb-4">
                <label for="notes" class="block font-medium mb-1">Catatan (Opsional)</label>
                <textarea name="notes" id="notes" class="w-full border border-gray-300 rounded px-3 py-2" rows="3"></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Kirim Booking
            </button>
        </form>
    </div>
</body>
</html>
