<title> لائحة الموضفين</title>

<x-app-layout>
<x-layout>
  <div class="d-flex align-items-center justify-content-between">
  <a href="{{ route('employee.index') }}"><h2>لائحة الموضفين </h2>
  </a>
  <nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
      <form action="{{route('employee.search')}}" class="d-flex" role="search" method="GET" >
        <input class="form-control me-2" type="search" placeholder="الاسم او رقم البطاقة الوطنية" aria-label="Search" name="term">
        <button style="width: 100px; max-height:50px;" class="btn btn-outline-success" type="submit">بحث</button>
      </form>
    </div>
  </nav>

  </div>
  @isset($term)
  @if (count($employees)<1 )

  <div style="text-align:center;">
    <p class="fs-4 pt-4"><strong>"{{$term}}"</strong>لا يوجد اي موظف  بهذا الاسم</p>
  </div>

  @endif
  @endisset
 

  <div class="container">
    <div class="row">
@isset($employees)
@foreach($employees as $employee)
<div class="col-lg-4 col-md-6 col-sm-12 mb-4 ">
<div class="card-hover" style="width: 220px; height: 254px; background: #ffffff; border-radius: 15px; box-shadow: 1px 5px 60px 0px rgba(0, 0, 0, 0.1);">
<div style="width: 60%; height: 3%; background: #a9a9ac; margin: auto; border-radius: 0px 0px 15px 15px;">
</div>
<div style="width: 70px; height: 40px; border-radius: 15px; margin: auto; margin-top: 25px;">
</div>
<span style="font-family: Verdana, Geneva, Tahoma, sans-serif;font-weight: 600; color: #524e4e; text-align: center; display: block; padding-top: 10px; font-size: 16px;"> {{ $employee->name }}</span>
<p style="font-weight: 400; color: #555555; display: block; text-align: center; padding-top: 3px; font-size: 12px;"> {{ $employee->grade }}</p>
<a href="{{ route('employee.show', $employee->id) }}" > <button class="button-hover" style="padding: 8px 25px; display: block; margin: auto; border-radius: 8px; border: none; margin-top: 30px; background: #ff6f61; color: white; font-weight: 600;"> رؤية المعلومات
</button></a>
</div>
</div>
@endforeach
</div>
</div>



{{ $employees->links() }}
@endisset


  @if(session('message'))
  <script>
    toastr.success("{{ session('message') }}");
  </script>
@endif
</x-layout>
</x-app-layout>