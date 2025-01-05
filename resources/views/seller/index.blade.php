@extends('seller.layouts.master')
@section('content')

    <div class="main">
        <div id="pageTitleDescription" class="py-3">
            <div class="container">
            <h1 class="my-1 fw-bold fs-1">Welcome back {{ auth()->user()->name }},</h1>
            <h4 class="fw-bold text-dark fs-3 mt-2">Sell or Rent your Property for <span
                class="ms-1 bg-warning text-light px-2 py-1 rounded-5 fs-5"> FREE! </span> </h4>

            </div>
        </div>
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

        <div class="container pb-5">
            <div class="grid grid-cols-1 mb-4 text-left">
                <h3 class="mb-4 fs-2 font-semibold leading-normal md:text-3xl md:leading-normal">People most visited
                    properties</h3>
            </div>
            <div class="col-lg-12 mb-5">
                <div class="row">
                    @foreach ($properties ?? [] as $key => $item)
                        <div class="col-lg-3">
                            <a href="{{ route('public.property_single', ['uid' => $item->unique_id, 'slug' => $item->slug]) }}"
                                target="_new">
                                <div class="relative overflow-hidden">

                                    <img src="{{ asset('images/' . $item->image) }}" style="height:230px"
                                        alt="{{ $key }}" class="rounded-bottom-0 rounded-xl duration-500 ">

                                </div>
                                <div class="border border-top-0 p-3 rounded-bottom-4 ">
                                    <span class="text-sm font-medium uppercase duration-500 ease-in-out hover:text-primary">
                                        {{ $item->name }}
                                    </span>
                                    <p class="truncate text-slate-600 dark:text-slate-300">
                                        <i class="mdi mdi-map-marker-outline"></i>
                                        {{ $item->location }}
                                    </p>
                                    <div class="flex flex-wrap gap-3 items-center justify-between pt-1 ps-0 mb-0 list-none">
                                        <li>
                                            <span class="text-slate-400">Price</span>
                                            <p class="text-lg font-semibold">{{ shorten_price($item->price) }}</p>
                                        </li>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

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
            var leadData = {
                categories: @json($leads->pluck('date')), // Get the dates
                series: [{
                    name: "Leads",
                    data: @json($leads->pluck('lead_count')) // Get the lead counts
                }]
            };

            var options = {
                chart: {
                    height: 280,
                    type: "area"
                },
                title: {
                    text: 'Weekly Property Leads',
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
                series: leadData.series,
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
                    categories: leadData.categories
                }
            };

            var chart = new ApexCharts(document.querySelector("#leadChart"), options);
            chart.render();



            ///////////////////////////////////////////////////

            var propertyStatusData = {
                series: [{
                    name: 'Sold',
                    data: [{{ $propertyStatusData->sold }}]
                }, {
                    name: 'Rented',
                    data: [{{ $propertyStatusData->rented }}]
                }, {
                    name: 'Renting',
                    data: [{{ $propertyStatusData->renting }}]
                }, {
                    name: 'Selling',
                    data: [{{ $propertyStatusData->selling }}]
                }, {
                    name: 'Pending',
                    data: [{{ $propertyStatusData->pending }}]
                }],
                categories: ["Property Status"] // You can change this to a specific time period if necessary
            };

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
                series: propertyStatusData.series,
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
                    categories: propertyStatusData.categories
                }
            };

            var chart2 = new ApexCharts(document.querySelector("#PropertyChart"), options2);
            chart2.render();

            ///////////////////////////////////////////////////

            var mostVisitedData = {
                series: [{
                    name: 'Views',
                    data: [
                        @foreach ($mostVisitedProperties as $property)
                            {{ $property->views }},
                        @endforeach
                    ]
                }],
                categories: [
                    @foreach ($mostVisitedProperties as $property)
                        '"{{ Str::limit($property->name,"5","...") }}"',
                    @endforeach
                ]
            };

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
                series: mostVisitedData.series,
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
                    categories: mostVisitedData.categories
                }
            };

            var chart3 = new ApexCharts(document.querySelector("#visitedChart"), options3);
            chart3.render();
        </script>
    @endpush
