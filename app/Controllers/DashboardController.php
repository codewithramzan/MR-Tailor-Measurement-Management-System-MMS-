<?php

class DashboardController extends Controller
{

    public function index()
    {

        $dashboard=new Dashboard();

        $data=[

            'customers'=>$dashboard->totalCustomers(),

            'bookings'=>$dashboard->totalBookings(),

            'pending'=>$dashboard->pendingBookings(),

            'ready'=>$dashboard->readyBookings(),

            'delivered'=>$dashboard->deliveredBookings(),

            'income'=>$dashboard->totalIncome(),

            'recent' => $dashboard->recentBookings(),

            'monthlyChart' => $dashboard->monthlyBookings(),

            'statusChart' => $dashboard->orderStatusChart()

        ];

        $this->view('dashboard/index',$data);

    }

}