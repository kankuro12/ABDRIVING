<div class="modal fade modal-lg m-0 p-0 " id="timesheet">
    <div class="modal-dialog modal-lg m-0 p-0">
        <div class="modal-content" style="height:100vh;overflow:scroll;">
            <div class="modal-header">
              <h5 class="modal-title font-weight-bold">
                  
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                <table class="table">
                    <tr>
                        <th >
                            Timeslot
                        </th>
                        <th colspan="8">
                            Students
                        </th>
                    </tr>
                   @foreach (\App\Models\Slot::all() as $slot)
                    <tr>
                        <td>
                            {{$slot->time}}
                        </td>
                        <td colspan="8">
                            @php
                                $std=\App\Models\Student::where('slot_id',$slot->id)->where('complete',0)->select('name')->get();
                                $ss=[];
                                foreach($std as $s){
                                    array_push($ss,$s->name);
                                }
                            @endphp
                            ( {{count($ss)}} Students )
                            {{implode(', ' ,$ss)}}
                        </td>
                    </tr>
                   @endforeach
                </table>
            </div>
        </div>
        </div>
    </div>
</div>
