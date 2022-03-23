<?php
use App\Models\User;

#read json data from given file and convert to array
if (!function_exists("readJsonFile"))
{
    function readJsonFile($filename)
    {
        return json_decode(
            file_get_contents($filename),
            true
        );
    }
}
#end

#if expire best before, put in end of array
if(! function_exists('sortByBestBefore') )
{
    function sortByBestBefore($data)
    {
        $expired = [];

        foreach ($data as $key => $value) {
            #if best before lower than now date, remove this from original array and add in expired array
            if ($value["best_before"] < date("Y-m-d")) {
                $expired[] = $value;
                unset($data[$key]);
            }
            #end
        }

        #merge 2 array and add expired array in end of array
        return array_merge(array_values($data), $expired);
    }
}
#end

#get min from a given column in a collection
if(! function_exists('minColumnInCollection') )
{
    function minColumnInCollection($collection, $column)
    {
        return $collection->min($column);
    }
}
#end

#call resource and convert data to array
if(! function_exists('callResource') ) {

    function callResource($resource, $data) {
        $resource = "App\Http\Resources\\".$resource;
        return json_decode((new $resource($data))->toJson(), true);
    }

}
#end


#create user for unit test
if(! function_exists('createUserForTest') )
{
    function createUserForTest()
    {
        $password = '123456789';
        $user = User::create([
            'name' => 'Test '. time(),
            'email'=> $email = time().'@example.com',
            'password' => bcrypt($password),
            'confirm_password' => bcrypt($password)
        ]);

        return [
            "user_id" => $user->id,
            "email" => $email,
            "password" => $password,
            "token" => "Bearer ".$user->createToken('authToken')->accessToken
        ];
    }
}
#end

#delete user that created for unit test
if(! function_exists('deleteUserForTest') )
{
    function deleteUserForTest($user_id)
    {
        User::where('id', $user_id)->delete();
    }
}
#end
