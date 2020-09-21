<?php
    function CountryToIso( $connection, $country_name ) {
        $alpha_3 = array(   "AFG","ALB","DZA","ASM","AND","AGO","AIA","ATA","ATG","ARG","ARM","ABW","AUS","AUT","AZE",
                            "BHS","BHR","BGD","BRB","BLR","BEL","BLZ","BEN","BMU","BTN","BOL","BOL","BIH","BWA","BVT",
                            "BRA","IOT","BRN","BRN","BGR","BFA","BDI","KHM","CMR","CAN","CPV","CYM","CAF","TCD","CHL",
                            "CHN","CXR","CCK","COL","COM","COG","COD","COK","CRI","CIV","CIV","HRV","CUB","CYP","CZE",
                            "DNK","DJI","DMA","DOM","ECU","EGY","SLV","GNQ","ERI","EST","ETH","FLK","FRO","FJI","FIN",
                            "FRA","GUF","PYF","ATF","GAB","GMB","GEO","DEU","GHA","GIB","GRC","GRL","GRD","GLP","GUM",
                            "GTM","GGY","GIN","GNB","GUY","HTI","HMD","VAT","HND","HKG","HUN","ISL","IND","IDN","IRN",
                            "IRQ","IRL","IMN","ISR","ITA","JAM","JPN","JEY","JOR","KAZ","KEN","KIR","PRK","KOR","KOR",
                            "KWT","KGZ","LAO","LVA","LBN","LSO","LBR","LBY","LBY","LIE","LTU","LUX","MAC","MKD","MDG",
                            "MWI","MYS","MDV","MLI","MLT","MHL","MTQ","MRT","MUS","MYT","MEX","FSM","MDA","MCO","MNG",
                            "MNE","MSR","MAR","MOZ","MMR","MMR","NAM","NRU","NPL","NLD","ANT","NCL","NZL","NIC","NER",
                            "NGA","NIU","NFK","MNP","NOR","OMN","PAK","PLW","PSE","PAN","PNG","PRY","PER","PHL","PCN",
                            "POL","PRT","PRI","QAT","REU","ROU","RUS","RUS","RWA","SHN","KNA","LCA","SPM","VCT","VCT",
                            "VCT","WSM","SMR","STP","SAU","SEN","SRB","SYC","SLE","SGP","SVK","SVN","SLB","SOM","ZAF",
                            "SGS","SSD","ESP","LKA","SDN","SUR","SJM","SWZ","SWE","CHE","SYR","TWN","TWN","TJK","TZA",
                            "THA","TLS","TGO","TKL","TON","TTO","TUN","TUR","TKM","TCA","TUV","UGA","UKR","ARE","GBR",
                            "USA","UMI","URY","UZB","VUT","VEN","VEN","VNM","VNM","VGB","VIR","WLF","ESH","YEM","ZMB","ZWE"
);
        $alpha_2 = array(   "AF","AL","DZ","AS","AD","AO","AI","AQ","AG","AR","AM","AW","AU","AT","AZ",
                            "BS","BH","BD","BB","BY","BE","BZ","BJ","BM","BT","BO","BO","BA","BW","BV",
                            "BR","IO","BN","BN","BG","BF","BI","KH","CM","CA","CV","KY","CF","TD","CL",
                            "CN","CX","CC","CO","KM","CG","CD","CK","CR","CI","CI","HR","CU","CY","CZ",
                            "DK","DJ","DM","DO","EC","EG","SV","GQ","ER","EE","ET","FK","FO","FJ","FI",
                            "FR","GF","PF","TF","GA","GM","GE","DE","GH","GI","GR","GL","GD","GP","GU",
                            "GT","GG","GN","GW","GY","HT","HM","VA","HN","HK","HU","IS","IN","ID","IR",
                            "IQ","IE","IM","IL","IT","JM","JP","JE","JO","KZ","KE","KI","KP","KR","KR",
                            "KW","KG","LA","LV","LB","LS","LR","LY","LY","LI","LT","LU","MO","MK","MG",
                            "MW","MY","MV","ML","MT","MH","MQ","MR","MU","YT","MX","FM","MD","MC","MN",
                            "ME","MS","MA","MZ","MM","MM","NA","NR","NP","NL","AN","NC","NZ","NI","NE",
                            "NG","NU","NF","MP","NO","OM","PK","PW","PS","PA","PG","PY","PE","PH","PN",
                            "PL","PT","PR","QA","RE","RO","RU","RU","RW","SH","KN","LC","PM","VC","VC",
                            "VC","WS","SM","ST","SA","SN","RS","SC","SL","SG","SK","SI","SB","SO","ZA",
                            "GS","SS","ES","LK","SD","SR","SJ","SZ","SE","CH","SY","TW","TW","TJ","TZ",
                            "TH","TL","TG","TK","TO","TT","TN","TR","TM","TC","TV","UG","UA","AE","GB",
                            "US","UM","UY","UZ","VU","VE","VE","VN","VN","VG","VI","WF","EH","YE","ZM","ZW");
    
        $iso_code_3 = $connection->query("SELECT DISTINCT iso_code FROM covid_data WHERE location = '$country_name'")->fetch_assoc()['iso_code'];
        return strtolower($alpha_2[ array_search( $iso_code_3, $alpha_3 ) ]);
    }

?>