@extends('metronic::layout',[
    'title' => 'All Groups',
    'create'  => route('group.create')
])
@section('content')
     
    @component('metronic::components.search-filters')
         damir@gmail.com 
        @component('metronic::components.form.text',['name'=>'name', 'label'=>'Name','inputOnly'=>true, 'value'=> request('name'), 'class'    =>'input-small'])
             
        @endcomponent
         
        @component('metronic::components.form.text',['name'=>'permissions', 'label'=>'Permissions','inputOnly'=>true, 'value'=> request('permissions'), 'class'    =>'input-small'])
             
        @endcomponent
         
    @endcomponent
     
    @component('metronic::components.block',[
        'title' => 'All Groups '
    ])
         
        @if(count($groups))
             
            @component('metronic::components.table')
                 
                @slot('thead')
                     
                    <th>
                         # 
                    </th>
                     
                    <th>
                         Name
                    </th>
                     
                    <th>
                         Permissions
                    </th>
                     
                    <th>
                        Actions
                    </th>
                     
                @endslot
                 
                @foreach($groups as $i => $group)
                     
                    <tr>
                         
                        <td>
                             {{ $i+1 }}
                        </td>
                         
                        <td>
                            {{$group->name}}
                        </td>
                         
                        <td>
                            {{ json_encode($group->permissions) }}
                        </td>
                         
                        <td>
                             
                            @component('metronic::components.button-delete',[
                            "route" => route('group.destroy', $group->id)
                        ])
                                 
                            @endcomponent
                             
                            @component('metronic::components.button-edit',[
                            "route" => route('group.edit', $group->id)
                        ])
                                 
                            @endcomponent
                             
                        </td>
                         
                    </tr>
                     
                @endforeach
                 
            @endcomponent
             
            <div class="text-center">
                 {{ $groups->render() }} 
            </div>
             
        @else
             
            <p>
                You do not have groups in database
            </p>
             
        @endif
         
    @endcomponent
@endsection