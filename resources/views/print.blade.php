<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Data Teman</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
  <body>
    <div class="container">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col text-center">
                    <h1>Aplikasi Data Teman</h1>
                </div>
            </div>

            {{-- Tabel --}}
            <div class="row mt-5">
                <div class="col">
                    <table class="table">
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
                            {{-- <canvas id="myChartJenisKelamin"></canvas> --}}
                            <img src="https://quickchart.io/chart?c={{ $chartJenis }}" alt="" class="img-thumbnail">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Cart Berdasarkan Usia
                        </div>
                        <div class="card-body">
                            {{-- <canvas id="myChartUsia"></canvas> --}}
                            <img src="https://quickchart.io/chart?c={{ $chartUsia }}" alt="" class="img-thumbnail">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>   
  </body>
</html>