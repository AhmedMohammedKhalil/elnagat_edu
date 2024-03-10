@push('css')
    <style>

        .col2{
            width: 20%;
        }
       .col3{
            width: 25%;
        }

        .col4{
            width: 35%;
        }

        .col5{
            width: 40%;
        }

        .col6{
            width: 50%;
        }

        .table-header td , .table-footer td {

        }

        .table-header td h4, .table-footer td h4 , .table-header td h3, .table-footer td h3 {
            color: white !important;
            background-color: #044c71 !important;
            margin: 0px 10px;
            border-radius: 10px;
            padding: 10px
        }

        p{
            color: black;
            font-size: 18px
        }

        @media print {
            .btn_preview,.btn_print{
                display: none
            }
        }

    </style>
@endpush

       <div>
        <div class="table-responsive">
            <table id="printme" class="display text-nowrap text-center" style="width:100%">

                    <tr>
                        <td class="col3" colspan="3">
                            <img src="{{ asset('assets/images/data/logo-1.png') }}" style="width: 150px;height:120px" alt="">
                        </td>
                        <td class="col5" colspan="5" style="padding-top: 20px">
                            <h2>متابعة&nbsp;منصة&nbsp;{{ $school->name }} </h2>
                        </td>
                        <td class="col2" colspan="2">
                            <span><a class="btn_preview" ><i class="las la-eye" style="font-size:40px; color:#044c71"></i></a></span>
                        </td>
                        <td class="col2" colspan="2">
                            <span><a class="btn_print" ><i class="las la-print" style="font-size:40px;color:#044c71"></i></a></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="col2" colspan="2"></td>
                        <td class="col2" colspan="2">
                            <div>
                                <h4>الأسبوع</h4>
                                <p>{{ $week->week_index }}</p>
                            </div>
                        </td>
                        <td class="col3" colspan="3">
                            <div>
                                <h4>التاريخ&nbsp;(من)</h4>
                                <p>{!! \Carbon\Carbon::parse($week->start_date)->translatedFormat("l Y-m-d") !!}</p>
                            </div>
                        </td>
                        <td class="col3" colspan="3">
                            <div>
                                <h4>التاريخ&nbsp;(إلى)</h4>
                                <p>{{ \Carbon\Carbon::parse($week->end_date)->translatedFormat("l Y-m-d") }}</p>
                            </div>
                        </td>
                        <td class="col2" colspan="2"></td>
                    </tr>
                    <tr style="border-top: 1px solid black;"></tr>
                    <tr>
                        <td class="col2" colspan="2"></td>
                        <td class="col4" colspan="4" >
                            <div style="padding-top:20px">
                                <h4>القسم</h4>
                                <p>{{ $department->name }}</p>
                            </div>
                        </td>
                        <td class="col4" colspan="4">
                            <div style="padding-top:20px">
                                <h4>رئيس&nbsp;القسم</h4>
                                <p>{{ $department->owner }}</p>
                            </div>
                        </td>
                        <td class="col2" colspan="2"></td>
                    </tr>

                    {{-- start table data header --}}
                    <tr class="table-header">
                        <td class="col3" colspan="3">
                            <h3>إسم&nbsp;المعلم</h3>
                        </td>
                        <td class="col2" colspan="2">
                            <h3>الواجبات&nbsp;المرفوعة</h3>
                        </td>
                        <td class="col2" colspan="2">
                            <h3>الدروس&nbsp;المحضرة</h3>
                        </td>
                        <td class="col2" colspan="2">
                            <h3>الخطة&nbsp;الأسبوعية</h3>
                        </td>
                        <td class="col3" colspan="3">
                            <h3>الملاحظات</h3>
                        </td>
                    </tr>
                    {{-- body --}}
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td class="col3" colspan="3">
                                <h4>{{ $teacher->name }}</h4>
                            </td>
                            <td class="col2" colspan="2">
                                <h4>{{ $teacher->tasks }}</h4>
                            </td>
                            <td class="col2" colspan="2">
                                <h4>{{ $teacher->lessons }}</h4>
                            </td>
                            <td class="col2" colspan="2">
                                <h4>{{ $teacher->weekly_plan }}</h4>
                            </td>
                            <td class="col3" colspan="3">
                                <h4 style="text-wrap:wrap">{!! $teacher->notes ?? 'لا يوجد ملاحظات' !!}</h4>
                            </td>
                        </tr>
                    @endforeach
                    {{-- end table data footer --}}
                    <tr class="table-footer">
                        <td class="col3" colspan="3">
                            <h3>الإجمالى</h3>
                        </td>
                        <td class="col2" colspan="2">
                            <h3>{{ $tasks }}</h3>
                        </td>
                        <td class="col2" colspan="2">
                            <h3>{{ $lessons }}</h3>
                        </td>
                        <td class="col2" colspan="2">
                            <h3>{{ $weekly_plan }}</h3>
                        </td>
                        <td class="col3" colspan="3"></td>
                    </tr>
                    <tr>
                        <td class="col12" colspan="12">
                            <div style="padding-top:20px;text-align:right">
                                <h4>المدير&nbsp;المساعد</h4>
                                <p>{{ $school->sub_admin->name }}</p>
                            </div>
                        </td>
                    </tr>
            </table>
        </div>
       </div>


@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>
<script>
    $(document).ready(function($)
	{


		$(document).on('click', '.btn_print', function(event)
		{
            document.querySelector(".btn_preview").style.visibility = "hidden";
            document.querySelector(".btn_print").style.visibility = "hidden";
			event.preventDefault();
			//credit : https://ekoopmans.github.io/html2pdf.js
            // $('.btn_preview').hide();
            // $('.btn_print').hide();
			var element = document.getElementById('printme');

			//easy
			//html2pdf().from(element).save();

			//custom file name
			//html2pdf().set({filename: 'code_with_mark_'+js.AutoCode()+'.pdf'}).from(element).save();


			//more custom settings
			var opt =
			{
              margin: [15, 0, 15, 0],
			  filename:     'report_'+{!! time() !!}+'.pdf',
			  image:        { type: 'jpg', quality: 1 },
              html2canvas: {
                    backgroundColor: "#fff",
                    scale: 1,
                    dpi:150,
                    y: 0,
                    x: 0,
                    scrollY: 0,
                    scrollX: 0,
                    windowWidth: 1240,
                },
                jsPDF: { unit: 'px', format: [1240, 1754], orientation: 'portrait' }
			  //html2canvas:  { scale: 2 },
			  //jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
			};

			// New Promise-based usage:


			html2pdf().set(opt).from(element).save().then(function() {
                //location.reload();
                document.querySelector(".btn_preview").style.visibility = "visible";
                document.querySelector(".btn_print").style.visibility = "visible";
            })

		});


        $(document).on('click', '.btn_preview', function(event)
		{
            document.querySelector(".btn_preview").style.visibility = "hidden";
            document.querySelector(".btn_print").style.visibility = "hidden";
			event.preventDefault();
			//credit : https://ekoopmans.github.io/html2pdf.js
            // $('.btn_preview').hide();
            // $('.btn_print').hide();
			var element = document.getElementById('printme');

			//easy
			//html2pdf().from(element).save();

			//custom file name
			//html2pdf().set({filename: 'code_with_mark_'+js.AutoCode()+'.pdf'}).from(element).save();


			//more custom settings
			var opt =
			{
            margin: [15, 0, 15, 0],
			  filename:     'report_'+{!! time() !!}+'.pdf',
			  image:        { type: 'jpeg', quality: 1 },
              html2canvas: {
                    backgroundColor: "#fff",
                    scale: 1,
                    y: 0,
                    x: 0,
                    dpi: 150,
                    scrollY: 0,
                    scrollX: 0,
                    windowWidth: 1240,
                },
                jsPDF: { unit: 'px', format: [1240, 1754], orientation: 'portrait' }
			  //html2canvas:  { scale: 2 },
			  //jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
			};

			// New Promise-based usage:

            html2pdf().set(opt).from(element).toPdf().get('pdf').then(function (pdf) {
                window.open(pdf.output('bloburl'), '_blank');
                document.querySelector(".btn_preview").style.visibility = "visible";
                document.querySelector(".btn_print").style.visibility = "visible";
            });
		});
	});
</script>
@endpush
