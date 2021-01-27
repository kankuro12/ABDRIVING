<div class="modal fade modal-lg m-0 p-0 " id="duelist">
    <div class="modal-dialog modal-lg m-0 p-0">
        <div class="modal-content" style="height:100vh;overflow:scroll;">
            <div class="modal-header">
              <h5 class="modal-title font-weight-bold">
                  Due List
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                @php

                    $students=\App\Models\Student::where('complete',0)->get();
                    $arr=[];
                    foreach($students as $student){
                        $amount=\App\Models\Payment::where('student_id',$student->id)->sum('amount');
                        $plans=\App\Models\Plan::where('course_id',$student->course_id)->orderBy('day','desc')->get();
                        if($student->dealamount>$amount){
                            $student->amount=$amount;
                            $student->dueamount=$student->dealamount-$amount;
                            array_push($arr,$student->toArray());
                        }
                        // foreach($plans as $plan){
                        //         if($amount<$plan->amount){
                        //             // echo $plan->amount.",".$amount."<hr>";
                        //             $student->amount=$amount;
                        //             $student->dueamount=$plan->amount-$amount;

                        //             // echo '<pre>';
                        //             // print_r($student->toArray());
                        //             // echo '</pre><hr>';
                        //             array_push($arr,$student->toArray());
                        //         }
                        // }
                    }
                @endphp
                <table id="" class="table">
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Phone
                        </th>
                        <th>
                            Paid Amount
                        </th>
                        <th>
                            Due Amount
                        </th>
                        <th>
                            Due Payment Date
                        </th>
                        <th>
                            Attendance
                        </th>
                    </tr>
                    @foreach ($arr as $student)
                    @php
                        $nextpaydate = \App\Models\Payment::latest()->where('student_id',$student['id'])->get();

                        $att = \App\Models\Attendance::where('student_id',$student['id'])->where('attend',1)->count();
                    @endphp
                        <tr>
                            <td>
                                {{$student['name']}}
                            </td>
                            <td>
                                {{$student['phone']}}
                            </td>
                            <td>
                                {{$student['amount']}}
                            </td>
                            <td>
                                {{$student['dueamount']}}
                            </td>
                            <th>
                                {{ $nextpaydate[0]->netpaydate }}
                            </th>
                            <th>
                                {{ $att }}
                            </th>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        </div>
    </div>
</div>
