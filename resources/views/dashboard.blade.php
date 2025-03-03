<x-app-layout>
        <!-- Welcome Section -->
        <div style="padding: 100px 0; text-align: center;">
            <div class="container">
                <h1 style="font-size: 3.5rem; font-weight: bold; margin-bottom: 20px;">مرحبًا بكم في نظام إدارة العطلات</h1><br>
                <p style="font-size: 1.2rem; margin-bottom: 40px;">
                    
                    نظام إدارة العطلات الخاص بجماعة العرائش يهدف إلى تبسيط وتسهيل عملية إدارة إجازات الموظفين. تتبع العطلات، إدارة طلبات الإجازة، وضمان سير العمل بسلاسة لفريقك.
                </p>
                <a href="{{ route('employee.index') }}" style="background-color: #ff6b6b; border: none; padding: 15px 30px; font-size: 1.2rem; border-radius: 50px; transition: background-color 0.3s ease; color: #fff; text-decoration: none;">
                    ابدأ الآن
                </a>
            </div>
        </div>
    
        <!-- Features Section -->
        <div style="padding: 80px 0; background-color: rgba(255, 255, 255, 0.1);">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 text-end">
                        <div style="background-color: rgba(255, 255, 255, 0.1); padding: 20px; border-radius: 10px; margin-bottom: 20px; transition: transform 0.3s ease;">
                            <h3 style="font-size: 1.5rem; margin-bottom: 15px;">تتبع العطلات بسهولة</h3>
                            <p style="font-size: 1rem;">
                                تتبع جميع عطلات الموظفين في مكان واحد. عرض العطلات المتبقية والطلبات المعتمدة والمزيد.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <div style="background-color: rgba(255, 255, 255, 0.1); padding: 20px; border-radius: 10px; margin-bottom: 20px; transition: transform 0.3s ease;">
                            <h3 style="font-size: 1.5rem; margin-bottom: 15px;">إدارة الموظفين</h3>
                            <p style="font-size: 1rem;">
                                أضف وادخل تفاصيل الموظفين، بما في ذلك حقوق العطلات وسجل الإجازات.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <div style="background-color: rgba(255, 255, 255, 0.1); padding: 20px; border-radius: 10px; margin-bottom: 20px; transition: transform 0.3s ease;">
                            <h3 style="font-size: 1.5rem; margin-bottom: 15px;">حسابات تلقائية</h3>
                            <p style="font-size: 1rem;">
                                احسب العطلات المتبقية تلقائيًا واستبعد عطلات نهاية الأسبوع لإدارة دقيقة.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Footer -->
        <div style="padding: 20px 0; background-color: rgba(0, 0, 0, 0.2); text-align: center;">
            <div class="container">
                <p style="margin: 0;">&copy;  {{ date('Y') }} نظام إدارة العطلات - جماعة العرائش. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    
        <!-- Bootstrap JS -->
</x-app-layout>
