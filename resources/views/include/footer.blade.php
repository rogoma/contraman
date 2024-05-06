            </div>
        </div>
    </div>
</div>
{{-- @if(Auth::user()->role_id == 6)
    @include('include.footers.minor_purchase')
@endif

@if(Auth::user()->role_id == 9)
    @include('include.footers.tenders')
@endif

@if(Auth::user()->role_id == 10)
    @include('include.footers.exceptions')
@endif

@if(Auth::user()->role_id == 7)
    @include('include.footers.awards')    
@endif --}}

{{-- ROL ADMINISTRADOR --}}
@if(Auth::user()->role_id == 1)
    @include('include.footers.contracts')
@endif

{{-- ROL CONTRATOS --}}
@if(Auth::user()->role_id == 8)
    @include('include.footers.contracts')
@endif

{{-- ROL DERIVAR CONTRATOS --}}
@if(Auth::user()->role_id == 26)
    @include('include.footers.contracts')
@endif