### HELLO WORLD

## Flow
'''
php -> js -> servlet -> js -> php   
through AJAX
'''


## js
'''
$.ajax({
            url: "servlet/registration.php",
            method: "POST",
            data:{

            },
            success: function(response){
                response = JSON.parse(response);
                if(response['status'] == 'success'){

                }else{
                    
                }
            }
        });
'''

## servlet
'''
$status = "success";
$data = "none";
echo json_encode(
    array(
        'status' => $status,
        'data' => $data
    )
);
'''

## Database Design
'''
![DB Design](image\DB.PNG)

username: root
password: toor
'''