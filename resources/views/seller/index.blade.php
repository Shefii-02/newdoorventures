@extends('seller.layouts.master')
@section('content')
  
    <div class="main">
        <div class="col-lg-12 mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div id="leadChart" class="card p-3 rounded-2xl">
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div id="PropertyChart" class="card p-3 rounded-2xl">
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div id="visitedChart" class="card p-3 rounded-2xl">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="grid grid-cols-1 mb-4 text-left">
                <h3 class="mb-4 fs-2 font-semibold leading-normal md:text-3xl md:leading-normal">People most visited
                    properties</h3>
            </div>
            <div class="col-lg-12 mb-5">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="relative overflow-hidden">
                            <a href="http://127.0.0.1:8000/projects/karle-zenith-residency">
                                <img src="http://127.0.0.1:8000/storage/karle-zenith-residences-2-600x400.jpg"
                                    alt="Karle Zenith Residency" class="rounded-bottom-0 rounded-xl duration-500 ">
                            </a>

                        </div>
                        <div class="border border-top-0 p-3 rounded-bottom-4 ">
                            <a href="http://127.0.0.1:8000/projects/karle-zenith-residency"
                                class="text-lg font-medium uppercase duration-500 ease-in-out hover:text-primary">
                                Karle Zenith Residency
                            </a>
                            <p class="truncate text-slate-600 dark:text-slate-300">
                                <i class="mdi mdi-map-marker-outline"></i>
                                Bangalore Central
                            </p>
                            <div class="flex flex-wrap gap-3 items-center justify-between pt-1 ps-0 mb-0 list-none">
                                <li>
                                    <span class="text-slate-400">Price</span>
                                    <p class="text-lg font-semibold">₹2.5 Cr - ₹4.8 Cr</p>
                                </li>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="relative overflow-hidden">
                            <a href="http://127.0.0.1:8000/projects/karle-zenith-residency">
                                <img src="http://127.0.0.1:8000/storage/karle-zenith-residences-2-600x400.jpg"
                                    alt="Karle Zenith Residency" class="rounded-bottom-0 rounded-xl duration-500 ">
                            </a>

                        </div>
                        <div class="border border-top-0 p-3 rounded-bottom-4 ">
                            <a href="http://127.0.0.1:8000/projects/karle-zenith-residency"
                                class="text-lg font-medium uppercase duration-500 ease-in-out hover:text-primary">
                                Karle Zenith Residency
                            </a>
                            <p class="truncate text-slate-600 dark:text-slate-300">
                                <i class="mdi mdi-map-marker-outline"></i>
                                Bangalore Central
                            </p>
                            <div class="flex flex-wrap gap-3 items-center justify-between pt-1 ps-0 mb-0 list-none">
                                <li>
                                    <span class="text-slate-400">Price</span>
                                    <p class="text-lg font-semibold">₹2.5 Cr - ₹4.8 Cr</p>
                                </li>



                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="relative overflow-hidden">
                            <a href="http://127.0.0.1:8000/projects/karle-zenith-residency">
                                <img src="http://127.0.0.1:8000/storage/karle-zenith-residences-2-600x400.jpg"
                                    alt="Karle Zenith Residency" class="rounded-bottom-0 rounded-xl duration-500 ">
                            </a>


                        </div>
                        <div class="border border-top-0 p-3 rounded-bottom-4 ">
                            <a href="http://127.0.0.1:8000/projects/karle-zenith-residency"
                                class="text-lg font-medium uppercase duration-500 ease-in-out hover:text-primary">
                                Karle Zenith Residency
                            </a>
                            <p class="truncate text-slate-600 dark:text-slate-300">
                                <i class="mdi mdi-map-marker-outline"></i>
                                Bangalore Central
                            </p>
                            <div class="flex flex-wrap gap-3 items-center justify-between pt-1 ps-0 mb-0 list-none">
                                <li>
                                    <span class="text-slate-400">Price</span>
                                    <p class="text-lg font-semibold">₹2.5 Cr - ₹4.8 Cr</p>
                                </li>



                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="relative overflow-hidden">
                            <a href="http://127.0.0.1:8000/projects/karle-zenith-residency">
                                <img src="http://127.0.0.1:8000/storage/karle-zenith-residences-2-600x400.jpg"
                                    alt="Karle Zenith Residency" class="rounded-bottom-0 rounded-xl duration-500 ">
                            </a>


                        </div>
                        <div class="border border-top-0 p-3 rounded-bottom-4 ">
                            <a href="http://127.0.0.1:8000/projects/karle-zenith-residency"
                                class="text-lg font-medium uppercase duration-500 ease-in-out hover:text-primary">
                                Karle Zenith Residency
                            </a>
                            <p class="truncate text-slate-600 dark:text-slate-300">
                                <i class="mdi mdi-map-marker-outline"></i>
                                Bangalore Central
                            </p>
                            <div class="flex flex-wrap gap-3 items-center justify-between pt-1 ps-0 mb-0 list-none">
                                <li>
                                    <span class="text-slate-400">Price</span>
                                    <p class="text-lg font-semibold">₹2.5 Cr - ₹4.8 Cr</p>
                                </li>



                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


      
    @stop


    @push('header')
        <style>
            .apexcharts-toolbar {
                display: none !important;
            }

            text.apexcharts-title-text {
                font-weight: 900;
            }
        </style>
    @endpush

    @push('footer')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <script>
            var options = {
                chart: {
                    height: 280,
                    type: "area"
                },
                title: {
                    text: 'Weekly Responses',
                    align: 'left',
                    margin: 10,
                    offsetX: 0,
                    offsetY: 0,
                    floating: false,
                    style: {
                        fontSize: '20px',
                        fontWeight: '900',
                        color: '#263238'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    name: "Series 1",
                    data: [45, 52, 38, 45, ]
                }],
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.9,
                        stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: [
                        "04 Jan",
                        "05 Jan",
                        "06 Jan",
                        "07 Jan"
                    ]
                }
            };

            var chart = new ApexCharts(document.querySelector("#leadChart"), options);

            chart.render();

            ///////////////////////////////////////////////////

            var options2 = {
                title: {
                    text: 'Property Status',
                    align: 'left',
                    margin: 10,
                    offsetX: 0,
                    offsetY: 0,
                    floating: false,
                    style: {
                        fontSize: '20px',
                        fontWeight: '900',
                        color: '#263238'
                    },
                },
                chart: {
                    height: 280,
                    type: "area"
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    name: "Series 1",
                    data: [45, 52, 38, 45, ]
                }],
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.9,
                        stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: [
                        "04 Jan",
                        "05 Jan",
                        "06 Jan",
                        "07 Jan"
                    ]
                }
            };

            var chart2 = new ApexCharts(document.querySelector("#PropertyChart"), options2);

            chart2.render();

            ///////////////////////////////////////////////////

            var options3 = {
                title: {
                    text: 'Visited Status',
                    align: 'left',
                    margin: 10,
                    offsetX: 0,
                    offsetY: 0,
                    floating: false,
                    style: {
                        fontSize: '20px',
                        fontWeight: '900',
                        color: '#263238'
                    },
                },
                chart: {
                    height: 280,
                    type: "area"
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    name: "Series 1",
                    data: [45, 52, 38, 45, ]
                }],
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.9,
                        stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: [
                        "04 Jan",
                        "05 Jan",
                        "06 Jan",
                        "07 Jan"
                    ]
                }
            };

            var chart3 = new ApexCharts(document.querySelector("#visitedChart"), options3);

            chart3.render();
        </script>
    @endpush
