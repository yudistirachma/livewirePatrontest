<div class="col-lg-8 mb-3">
    <div class=" mb-3 d-flex justify-content-between">
        <form class=" navbar-search " wire:submit.prevent="updatingSearch" style="width: 50%;">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control border-0 small bg-white" placeholder="name or ktp num..." aria-label="Search" aria-describedby="basic-addon2" wire:model.defer="search">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
        <div href="#" class="btn btn-sm btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-folder-plus"></i>
            </span>
            <span class="text"><small class="font-weight-bold">Content</small></span>
        </div>
    </div>
    <ul class="list-group">
        <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="font-weight-bold">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</h6>
                    <div class="d-flex align-items-center">
                        <img class="img-profile rounded-circle" src="http://localhost:8000/tamplate/img/undraw_profile.svg" style="height: 30px">
                        <small class="mx-1 font-weight-bold">Rahma yudistira</small>&middot;<small class="mx-1">Deadline 30 Nov 2020</small>
                    </div>
                </div>
                <div class="text-center">
                    <span class="badge badge-pill mx-auto badge-danger"><small>Late</small></span>
                    <span class="badge badge-pill mx-auto badge-success"><small>Verified</small></span>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="font-weight-bold">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</h6>
                    <div class="d-flex align-items-center">
                        <img class="img-profile rounded-circle" src="http://localhost:8000/tamplate/img/undraw_profile.svg" style="height: 30px">
                        <small class="mx-1 font-weight-bold">Rahma yudistira</small>&middot;<small class="mx-1">Deadline 30 Nov 2020</small>
                    </div>
                </div>
                <div>
                    <span class="badge badge-pill badge-success"><small>Verified</small></span>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="font-weight-bold">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</h6>
                    <div class="d-flex align-items-center">
                        <img class="img-profile rounded-circle" src="http://localhost:8000/tamplate/img/undraw_profile.svg" style="height: 27px">
                        <small class="mx-1 font-weight-bold">Rahma yudistira</small>&middot;<small class="font-weight-light">Deadline 30 Nov 2020</small>
                    </div>
                </div>
                <div>
                    <span class="badge badge-pill badge-success"><small>Verified</small></span>
                </div>
            </div>
        </li>
    </ul>
</div>
