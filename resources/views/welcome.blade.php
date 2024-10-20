@extends('layouts.app')

@section('content')
    <div style="background:url('/hero.png');">
        <div  class="container">
            <div class="py-4">
                <h1 class="ts">TUPAD Tracker: Monitoring the Impact of TUPAD Program</h1>
                <h3 class="ts">Empowering Transparency and Efficiency in TUPAD Benefits</h3>
                <a href="/login" class="btn btn-success">Get Started</a>
            </div>
        </div>
    </div>
<div class="container py-4">
        <h4>
            Introducing TUPAD Tracker
        </h4>
        <p>
            The TUPAD program aims to provide financial assistance to vulnerable sectors. Our application helps monitor and track the benefits, ensuring transparency and efficiency.
        </p>
        <h4 class="mt-4">
            What is TUPAD Tracker?
        </h4>
        <p>
            TUPAD Tracker is a digital solution designed to monitor and evaluate the effectiveness of the TUPAD program. Our application enables:
        </p>
        <div>
            <img src="/check-mark.png" style="width:25px;" alt=""> Real-time tracking of beneficiary information
        </div>
        <div>
            <img src="/check-mark.png" style="width:25px;" alt=""> Automated reporting and analytics
        </div>
        <div>
            <img src="/check-mark.png" style="width:25px;" alt=""> Enhanced transparency and accountability
        </div>
        <div class="row mt-2 g-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Benefits for Beneficiaries:
                    </div>
                    <div class="card-body">
                        <div>
                            <img src="/check-mark.png" style="width:25px;" alt=""> Easy access to benefit information
                        </div>
                        <div>
                            <img src="/check-mark.png" style="width:25px;" alt=""> Secure and transparent transactions
                        </div>
                        <div>
                            <img src="/check-mark.png" style="width:25px;" alt=""> Timely updates on program status
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Benefits for Administrators:
                    </div>
                    <div class="card-body">
                        <div>
                            <img src="/check-mark.png" style="width:25px;" alt=""> Streamlined monitoring and evaluation
                        </div>
                        <div>
                            <img src="/check-mark.png" style="width:25px;" alt=""> Data-driven insights for program improvement
                        </div>
                        <div>
                            <img src="/check-mark.png" style="width:25px;" alt=""> Enhanced accountability and transparency
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="mt-4">
            Features
        </h4>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <img style="width:50px;" src="/contact.png"/> Beneficiary Profiling
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <img style="width:50px;" src="/report.png"/>  Reports
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <img style="width:50px;" src="/secure-data.png"/> Secure Login and Access Control
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <img style="width:50px;" src="/imaging.png"/> Image Analysis
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
