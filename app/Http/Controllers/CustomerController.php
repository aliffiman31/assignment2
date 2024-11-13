<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    //

    public function index(Request $request)
    {
        // Retrieve filters from the request
        $gender = $request->input('gender');
        $birthdayFilter = $request->input('birthday');
        $rowsPerPage = $request->input('rowsPerPage', 10); // Default to 10 rows per page

        // Start building the query
        $query = Customer::query();

        // Apply gender filter if provided
        if ($gender) {
            $query->where('gender', $gender);
        }

        // Apply birthday filter (born after the year 2000) if selected
        if ($birthdayFilter === 'after2000') {
            $query->whereYear('birthday', '>', 2000);
        }

        // Paginate results based on rows per page
        $customers = $query->paginate($rowsPerPage);

        // Pass data to the view
        return view('index', compact('customers', 'gender', 'birthdayFilter', 'rowsPerPage'));
    }
}
