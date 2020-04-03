@extends('main-layout')

@section('content')
    
    @foreach ($aFolder as $oFolder)
        @foreach ($oFolder->messages()->all()->get() as $oMessage)
            <div class="card">
                <div class="card-header" id="inbox-{{$count}}">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#inbox-{{$count}}" aria-expanded="true" aria-controls="collapseOne">
                            {{$oMessage->getSubject()}}
                            
                        </button>
                    </h5>
                </div>

                <div id="inbox-{{$count}}" class="collapse show" aria-labelledby="inbox-{{$count++}}" data-parent="#accordion">
                    <div class="card-body">
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
@endsection