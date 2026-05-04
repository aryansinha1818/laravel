@include('common.new')
<div>
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
    <h1>About 2 </h1>
    <h2>hello</h2>
    <h4>{{ $name }}</h4>

    <h1>{{ rand() }}</h1>

    @if($name == 'rishab')
    <h1>yes</h1>
    @else
    <h1>no</h1>
    @endifq
</div>

<div>
    @for($i=0;$i<=10;$i++)
        <h1>{{ $i }}</h1>
        @endfor
</div>