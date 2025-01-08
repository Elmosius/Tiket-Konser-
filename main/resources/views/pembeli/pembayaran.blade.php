<!DOCTYPE html>
<html lang="en">

    @include('layouts.pembeli-penjual-guess.header')
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<body class="bg-gray-100 ">
    @include('layouts.pembeli-penjual-guess.navbar')

    <!-- Hero Section -->
    {{-- Carousel tiket --}}
    @include('layouts.pembeli-penjual-guess.hero')

    <!-- Event Cards -->
    <!-- Event Cards Container -->
    <div class="flex flex-wrap mx-10 my-5">
        <h1 class="w-full text-2xl font-bold mb-3">Pembayaran Tiket</h1>
        <!-- Event Card -->
        @foreach ($pembelians as $pembelian)
        @if($pembelian->status == 0)
            <div class="w-full sm:w-1/2 lg:w-1/3 p-4 m-2 mt-1 mb-5">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="p-4 bg-blue-500 text-white">
                        <h3 class="text-lg font-bold">Pembelian ID: {{$pembelian->id}}</h3>
                        <p>Total: Rp.<span class="font-semibold">{{ number_format($pembelian->total, 2, ',', '.') }}</span></p>
                    </div>
                    <div class="m-3 mx-4">
                        <p>Total: Rp{{ number_format($pembelian->total, 2, ',', '.') }}</p>
                        <p>Status:
                            @if ($pembelian->status == 0)
                                <span class="text-red-500">Belum Lunas</span>
                            @else
                                <span class="text-green-500">Lunas</span>
                            @endif
                        </p>
                        <div class="mt-3">
                            <h5 class="font-bold text-lg mb-2">Detail Pembelian:</h5>
                            @foreach ($pembelian->details as $detail)
                                {{-- @dd($detail) --}}
                                <div class="overflow-hidden overflow-x-auto border border-gray-200 rounded-lg my-2 p-2">
                                    <table class="min-w-full text-sm divide-y divide-gray-200">
                                        <tbody class="bg-white">
                                            <!-- Baris untuk Produk -->
                                            <tr>
                                                <td class="p-1 font-medium text-gray-900 whitespace-nowrap" colspan="2">
                                                    Tiket : {{ $detail->tiket->nama_tiket }}
                                                </td>
                                            </tr>
                                            <!-- Baris untuk Jumlah -->
                                            <tr>
                                                <td class="p-1 text-gray-700 whitespace-nowrap"></td>
                                                <td class="p-1 text-gray-700 whitespace-nowrap">
                                                    Jumlah : {{ $detail->jumlah }}
                                                </td>
                                            </tr>
                                            <!-- Baris untuk Harga -->
                                            <tr>
                                                <td class="p-1 text-gray-700 whitespace-nowrap"></td>
                                                <td class="p-1 text-gray-700 whitespace-nowrap">
                                                    Harga : Rp{{ number_format($detail->tiket->harga, 2, ',', '.') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                            @if ($pembelian->status == 0)
                                <div class="flex justify-center items-center">
                                    <a href="{{route('pemesanan-create',['pembelian'=>$pembelian->id])}}" class="inline-block w-full px-6 py-2 text-white bg-red-500 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 transition ease-in-out duration-150 text-center">
                                        Lakukan Pembayaran
                                    </a>
                                </div>
                            @endif                        
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @endforeach
    </div>

    <!-- Footer -->
    @include('layouts.pembeli-penjual-guess.footer')

    <!-- Extra JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="{{ asset('/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    @yield('extra-js')
</body>
</html>