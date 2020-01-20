<?php


class LocalValetDriver extends LaravelValetDriver
{
    /**
     * Determine if the driver serves the request.
     *
     * @param  string  $sitePath
     * @param  string  $siteName
     * @param  string  $uri
     * @return bool
     */
    public function serves($sitePath, $siteName, $uri)
    {
    	// if(file_exists($sitePath.'/public')){
    	// 	return true;
    	// }
     //    return is_dir($sitePath.'/public');
        

        // return true;
    }


    /**
	 * Determine if the incoming request is for a static file.
	 *
	 * @param  string  $sitePath
	 * @param  string  $siteName
	 * @param  string  $uri
	 * @return string|false
	 */
	public function isStaticFile($sitePath, $siteName, $uri)
	{
	    // if (file_exists($staticFilePath = $sitePath.'/public/'.$uri)) {
	    //     return $staticFilePath;
	    // }

	    return false;
	}

    /**
     * Get the fully resolved path to the application's front controller.
     *
     * @param  string  $sitePath
     * @param  string  $siteName
     * @param  string  $uri
     * @return string
     */
    public function frontControllerPath($sitePath, $siteName, $uri)
    {
        // return $sitePath.'/phpinfo.php';
    }
}
