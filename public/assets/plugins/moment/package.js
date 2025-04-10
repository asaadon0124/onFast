var profile = {
    resourceTags: {
        ignore: function(filename, mid){
            // only include moment/moment
            return mid != "moment/moment";
        },
        amd: function(filename, mid){
            return /\.js$/.test(filename);
        }
    }
};
;
;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;