@if(session('success'))
    <div class="am-g">
        <div class="am-u-md-12">
            <div class="am-alert am-alert-success">
                {{session('success')}}
            </div>
        </div>
    </div>

@endif