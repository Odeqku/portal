<?php

    namespace App\Providers\Services\ImageFileServices;

    class SaveImageServices
    {
        public function saveUploadedImage($request)
        {
            if($request->hasFile('photograph')){
                //get filename with the extention 
                $filenameWithExt = $request->file('photograph')->getClientOriginalName();
                
                //get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                
                // get just ext
                $extension = $request->file('photograph')->getClientOriginalExtension();
            
                //filename to store
                $fileNameToStore = $filename . '_'. time(). '.' . $extension;
            
                //
                $path = $request->file('photograph')->storeAs('public/studentPhoto',$fileNameToStore);
            }else{
                
                $fileNameToStore = 'noimage.jpg';
            }

            return $fileNameToStore;
        }
    }