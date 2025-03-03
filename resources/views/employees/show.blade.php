<title>رؤية المعلومات</title>
<x-app-layout>
  <x-layout>
  <div class="d-flex align-items-center justify-content-between">
  <h2 class="fs-3">{{ $employee->name }}</h2>
  <div>
    <!-- Button trigger modal -->
    @php
    $extraHoliday = false;

    if (isset($lastHoliday)) {
        if (
            ($lastHoliday->type == "administrative" && $lastHoliday->remaining_leave == 0) ||
            ($lastHoliday->type == "exceptional" && $lastHoliday->remaining_leave > 0)
        ) {
            $extraHoliday = true;
        }
    }
@endphp




<button type="button" class="btn btn-primary text-primary" style="font-weight: bold" data-bs-toggle="modal" data-bs-target="#exampleModal2" {{ !$extraHoliday ? 'disabled' : '' }}>
  إضافة عطلة استثنائية</button>
{{-- add holiday button  --}}
<button type="button" class="btn btn-primary text-primary" style="font-weight: bold" data-bs-toggle="modal" data-bs-target="#exampleModal" {{ $extraHoliday ? 'disabled' : '' }}>
  اضافة عطلة
</button>

<!-- Modal for add normal holiday -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">اضافة عطلة</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('holiday.store',['id'=>$employee->id]) }}" method="POST">
          @csrf
    
          <!-- employee vacation start -->
          <label for="leave_start">تاريخ  الخروج  </label>
          <input 
            type="date" 
            id="leave_start" 
            name="leave_start"
            required
          >
      
                
          <!-- employee vacation end -->
          <label for="leave_end">تاريخ الدخول</label>
          <input 
            type="date" 
            id="leave_end" 
            name="leave_end"
            required
          >
        
      
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary text-info" data-bs-dismiss="modal">الغاء</button>
            <button type="submit" class="btn btn-primary text-info">اضافة</button>
          </div>
      
          <!-- validation errors -->
          @if ($errors->any())
            <ul class="px-4 py-2 bg-red-100">
              @foreach ($errors->all() as $error)
                <li class="my-2 text-red-500">{{ $error }}</li>
              @endforeach
            </ul>
          @endif
          
        </form>
      </div>

    </div>
  </div>
</div>






<!-- Modal for add exceptioneel holiday -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel2">إضافة عطلة استثنائية </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('holiday.extraHoliday',['id'=>$employee->id]) }}" method="POST">
          @csrf
    
          <!-- employee vacation start -->
          <label for="leave_start">تاريخ  الخروج </label>
          <input 
            type="date" 
            id="leave_start" 
            name="leave_start"
            required
          >
      
                
          <!-- employee vacation end -->
          <label for="leave_end">تاريخ الدخول</label>
          <input 
            type="date" 
            id="leave_end" 
            name="leave_end"
            required
          >
        
      
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary text-info" data-bs-dismiss="modal">الغاء</button>
            <button type="submit" class="btn btn-primary text-info">اضافة</button>
          </div>
      
          <!-- validation errors -->
          @if ($errors->any())
            <ul class="px-4 py-2 bg-red-100">
              @foreach ($errors->all() as $error)
                <li class="my-2 text-red-500">{{ $error }}</li>
              @endforeach
            </ul>
          @endif
          
        </form>
      </div>

    </div>
  </div>
</div>



  </div>
  </div>

  <div class="bg-gray-200 p-4 rounded  " style="text-align: end">
    <p class="fs-3"> {{ $employee->national_id }} <strong>   : رقم البطاقة الوطنية</strong></p>
    <p class="fs-3"> {{ $employee->department }} <strong   >: القسم</strong></p>
    <p class="fs-3" > {{ $employee->grade }} <strong   >: الرتبة</strong></p>
  </div>


  {{-- dojo info --}}
  <div class="border-2 border-dashed bg-white px-4 pb-4 my-4 rounded">
    <table class="table table-hover">
      <thead>
        <tr>
          <th >نوع العطلة</th>
          <th >الباقي</th>
          <th >مجموع العطل المأخوذة </th>
          <th >تاريخ  الدخول</th>
          <th >تاريخ الخروج</th>
          <th >مجموع العطل </th>
          <th >السنة</th>
        </tr>
      </thead>
      <tbody>
        @isset($holidays)
        @foreach ($holidays as $holiday)
        <tr>
          <td>{{$holiday->type}}</td>
          <td>{{$holiday->remaining_leave}}</td>
          <td>{{$holiday->total_leave - $holiday->remaining_leave}}</td>
          <td>{{$holiday->leave_end}}</td>
          <td>{{$holiday->leave_start}}</td>
          <td>{{$holiday->total_leave}}</td>
          <td>{{$holiday->year}}</td>

        </tr>
    @endforeach
        @endisset
       
      </tbody>
    </table>
    @isset($holidays)
    {{ $holidays->links() }}
    @endisset
  </div>
<table>
  <tr>
    <td>
      <form class="  p-0 m-0" action="{{ route('employee.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من أنك تريد حذف هذا الموظف؟');">
        @csrf
        @method('DELETE')
    
        <button type="submit" class="btn my-4">حذف الموظف</button>
    </form>
    </td>
   
    <td>
      <a class="p-0 m-0 ms-2"  href="{{ route('employee.edit',["id"=>$employee->id]) }}">
        <button type="submit" class="btn my-4 ">تغيير المعلومات  </button>
      </a>
    </td>
  </tr>
</table>
  

</div>

@if(session('success'))
<script>
  toastr.success("{{ session('success') }}");
</script>
@endif

@if(session('error'))
<script>
  toastr.error("{{ session('error') }}");
</script>
@endif

@if ($errors->has('leave_end'))
<script>
  toastr.error("تاريخ الخروج يجب ان يكون اقدم من تاريخ الدخول");
</script>
@endif
</x-layout>
</x-app-layout>