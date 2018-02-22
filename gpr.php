public function gpr(){
        $url = 'https://widget.kominfo.go.id/data/latest/gpr.xml'; //URL XML GPR Kominfo
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

        $xmlstr = curl_exec($ch);
        curl_close($ch);

        $xml = new SimpleXMLElement($xmlstr);

        $data = array(); //array untuk menyimpan hasil parsing XML GPR Kominfo

        foreach ($xml->item as $item) {
            //proses parsing
            $title = $item->title; //Get Judul artikel
            $pubDate = $item->pubDate; //get tanggal
            $link = $item->link; //get URL

            //simpan data hasil parsing ke array $data[]
            $data[] = array(
                'judul' => $title,
                'tgl' => $pubDate,
                'link' => $link,
            );
        }

        //menampilkan data
        foreach ($data as $d){
            echo $d['judul'].'<br>'; //Menampilkan judul artikel
            echo $d['link'].'<br>'; //menampilkan URL
            echo $d['tgl'].'<br><br>'; //Menampilkan Tanggal Artikel
        }
    }
