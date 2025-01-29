<x-auth>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <img src="/section.jpg" alt="" class="card-img-top">
                    <div class="card-body">
                       <div class="d-flex justify-content-between align-items-center">
                        <h4>{{$title->title}} </h4>
                        <span class="badge bg-primary">{{$title->status}}</span>
                       </div>
                        <div>
                            {{$title->description}}
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                Faculty
                            </div>
                            <div class="col-6">
                                {{$title->faculty->name}}
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                Area of research
                            </div>
                            <div class="col-6">
                                {{$title->area_of_research}}
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                IC type
                            </div>
                            <div class="col-6">
                                {{$title->ic_type}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth>
