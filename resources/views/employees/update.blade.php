<title>تغيير المعلومات</title>
<x-app-layout>
  <x-layout>
    @isset($employee)
    <form action="{{ route('employee.update',['id'=>$employee->id]) }}" method="POST">
        @csrf
        @method("PUT")
    
        <h2> تغيير المعلومات </h2>
    
        <!-- employee Name -->
        <label for="name">الاسم الكامل</label>
        <input 
          type="text" 
          id="name" 
          name="name"
          value="{{$employee->name}}"
          required
        >
    
        <!-- employee cin -->
        <label for="national_id"> البطاقة الوطنية </label>
        <input 
          type="text" 
          id="national_id" 
          value="{{$employee->national_id}}"
          name="national_id"
          required
        >
    
        
        <!-- employee grad -->
        <label for="grade">الرتبة</label>
        <input 
          type="text" 
          id="grade" 
          value="{{$employee->grade}}"
          name="grade"
          required
        >
    
        
        <!-- employee department -->
        <label for="department">القسم</label>
        <input 
          type="text" 
          value="{{$employee->department}}"
          id="department" 
          name="department"
          required
        >
    
    
    
        <button type="submit" class="btn mt-4"> حفظ التعديلات </button>
    
        <!-- validation errors -->
        @if ($errors->any())
          <ul class="px-4 py-2 bg-red-100">
            @foreach ($errors->all() as $error)
              <li class="my-2 text-red-500">{{ $error }}</li>
            @endforeach
          </ul>
        @endif
        
      </form>
    
      @if(session('message'))
      <script>
        toastr.success("{{ session('message') }}");
      </script>
    @endif
    @endisset



  </x-layout>
</x-app-layout>