<?php

namespace App\Http\Controllers;

use App\Models\Teman;
use Illuminate\Http\Request;
use PDF;

class TemanController extends Controller
{
    //
    public function index()
    {
        $data           = Teman::get();

        if (count($data) > 0) {
            # code...
            $dibawah        = (count($data->where('usia', '<=', 19)) / count($data)) * 100;
            $diatas         = (count($data->where('usia', '>=', 20)) / count($data)) * 100;

            $laki           = (count($data->where('jenis_kelamin', 'laki-laki')) / count($data)) * 100;
            $perempuan      = (count($data->where('jenis_kelamin', 'perempuan')) / count($data)) * 100;
        } else {
            # code...
            $dibawah        = 0;
            $diatas         = 0;

            $laki           = 0;
            $perempuan      = 0;
        }



        return view('index', compact('data', 'dibawah', 'diatas', 'laki', 'perempuan'));
    }

    public function store(Request $request)
    {
        # code...
        Teman::create([
            'name'          => $request->name,
            'jenis_kelamin' => $request->jenis_kelamin,
            'usia'          => $request->usia
        ]);
        return redirect('/');
    }

    public function print()
    {
        # code...
        $data           = Teman::get();

        $dibawah        = (count($data->where('usia', '<=', 19)) / count($data)) * 100;
        $diatas         = (count($data->where('usia', '>=', 20)) / count($data)) * 100;

        $laki           = (count($data->where('jenis_kelamin', 'laki-laki')) / count($data)) * 100;
        $perempuan      = (count($data->where('jenis_kelamin', 'perempuan')) / count($data)) * 100;

        $chartJenis     = "{
            type: 'pie',
            options: {
                responsive: true
            },
            data: {
                labels: ['Laki - laki', 'Perempuan'],
                datasets: [{
                    data: [" . $laki . ", " . $perempuan . "],
                    label: 'Persentase',
                    borderWidth: 1
                }]
            }
        }";
        $chartUsia       = "{
                type: 'pie',
                options: {
                    responsive: true
                },
                data: {
                    labels: ['Usia kurang dari 19 tahun', 'Usia lebih dari 20 tahun'],
                    datasets: [{
                        data: [" . $dibawah . ", " . $diatas . "],
                        label: 'Persentase',
                        borderWidth: 1
                    }]
                }
            }";
        // dd(urlencode($chartJenis));

        $pdf            = PDF::loadview('print', compact('data', 'dibawah', 'diatas', 'laki', 'perempuan', 'chartJenis', 'chartUsia'));
        return $pdf->stream('data-teman.pdf');
        // return view('print', compact('data', 'dibawah', 'diatas', 'laki', 'perempuan'));
    }
}
