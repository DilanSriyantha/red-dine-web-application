class Utils {
    static async compressImage(file){
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);

            reader.onload = (e) => {
                const img = new Image();
                img.src = e.target.result;

                img.onload = () => {
                    const canvas = document.createElement("canvas");
                    const context = canvas.getContext("2d");
    
                    const scale = 0.10;
                    const new_width = img.width * scale;
                    const new_height = img.height * scale;
    
                    canvas.width = new_width;
                    canvas.height = new_height;
    
                    context.drawImage(img, 0, 0, new_width, new_height);
    
                    const base64 = canvas.toDataURL("image/jpeg", 0.5);
                    
                    resolve(base64);
                }

                img.onerror = (err) => reject(err);
            };

            reader.onerror = (err) => reject(err);
        });
    }
}