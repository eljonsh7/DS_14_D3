# DS_14_D3

Tema e projektit: Aplikacioni për komunikimin klient-server (TCP) ku të dhënat mes aplikacioneve shkëmbehen të enkriptuara me DES-CBC, kurse çelësi sekret mbrohet me çelës publik. Komunikimi vetëm nga Klienti te Serveri.

Përshkrimi i projektit: Për punimin e projektit kemi përdorur HTML, JavaScript, PHP. Gjatë punimit të projektit kemi përdor librarinë e gatshme të Javascript-it për enkriptim dhe deenkriptim CryptoJs. CryptoJS mund të përdoret për të kriptuar dhe dekriptuar të dhëna me shumë algoritme kriptografike ndër to edhe DES algoritmi.

Zhvillimi i projektit: Tek login.php logohemi ose regjistrohemi dhe shkojmë tek client.php. Pastaj mund të shënojmë çelësin dhe mesazhin që dëshirojmë t'a enkriptojmë. Mesazhi enkriptohet me çelësin që ne e shkruajmë, çelësi privat enkriptohet me çelës publik në publicKey.pem. Mund të shkojmë pastaj tek server.php dhe të marrim mesazhet që i kemi shkruar ne me çelës të caktuar. Çelësi i enkriptuar dekriptohet me çelësin publik dhe pastaj me çelës të dekripptuar dekriptohet mesazhi. Dalin mesazhet që vetëm useri i caktuar i ka enkriptuar.

Projektin e punuan:
• Eljon Shala,
• Elma Ahmeti,
• Elonita Krasniqi.
