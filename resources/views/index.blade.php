<!doctype html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Data Teman</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    </head>
  <body>
    <div class="container">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col text-center">
                    <h1>Aplikasi Data Teman</h1>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah Data Teman
                    </button>
                    <a href="/cetak-pdf" target="_blank" class="btn btn-warning">Cetak Data</a>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Form Tambah Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/simpan-data" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama Teman" required>
                                    <label for="name">Nama Teman</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="jenis-kelamin" aria-label="Jenis Kelamin" name="jenis_kelamin" required>
                                        <option value="" selected>Pilih</option>
                                        <option value="laki-laki">Laki - laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                    <label for="jenis-kelamin">Jenis Kelamin</label>
                                </div>
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="usia" name="usia" placeholder="Usia" min="1" max="120" required>
                                    <label for="usia">Usia</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Tabel --}}
            <div class="row mt-5">
                <div class="col">
                    <table class="table" id="tabel-teman">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Usia</th>
                                <th scope="col">Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td>
                                        {{ $item->usia }} Tahun
                                    </td>
                                    <td>
                                        {{ $item->jenis_kelamin == "perempuan" ? "Perempuan" : "Laki - laki" }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div>
                <input type="hidden" name="hidden-value-dibawah" id="dibawah" value="{{ $dibawah }}">
                <input type="hidden" name="hidden-value-diatas" id="diatas" value="{{ $diatas }}">
                <input type="hidden" name="hidden-value-dibawah" id="laki" value="{{ $laki }}">
                <input type="hidden" name="hidden-value-diatas" id="perempuan" value="{{ $perempuan }}">
            </div>
            
            {{-- Cart --}}
            <div class="row mt-5 mb-5">
                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Cart Berdasarkan Jenis Kelamin
                        </div>
                        <div class="card-body">
                            <canvas id="myChartJenisKelamin"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Cart Berdasarkan Usia
                        </div>
                        <div class="card-body">
                            <canvas id="myChartUsia"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <script>
        let dibawah     = document.getElementById('dibawah').value;
        let diatas      = document.getElementById('diatas').value;
        let laki        = document.getElementById('laki').value;
        let perempuan   = document.getElementById('perempuan').value;

        const ctx = document.getElementById('myChartUsia');
        const cty = document.getElementById('myChartJenisKelamin');

        new Chart(ctx, {
            type: 'pie',
            options: {
                responsive: true
            },
            data: {
                labels: ['Usia kurang dari 19 tahun', 'Usia lebih dari 20 tahun'],
                datasets: [{
                    data: [dibawah, diatas],
                    label: 'Persentase',
                    borderWidth: 1
                }]
            }
        });

        new Chart(cty, {
            type: 'pie',
            options: {
                responsive: true
            },
            data: {
                labels: ['Laki - laki', 'Perempuan'],
                datasets: [{
                    data: [laki, perempuan],
                    label: 'Persentase',
                    borderWidth: 1
                }]
            }
        });
    </script>

    
    <script>
        // let table = new DataTable('#tabel-teman');
        $(document).ready(function () {
            $('#tabel-teman').DataTable();
        });
    </script>
  </body>
</html>