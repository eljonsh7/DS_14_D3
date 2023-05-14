# DS_14_D3

Tema e projektit: Aplikacioni për komunikimin klient-server (TCP) ku të dhënat mes aplikacioneve shkëmbehen të enkriptuara me DES-CBC, kurse çelësi sekret mbrohet me çelës publik. Komunikimi vetëm nga Klienti te Serveri.

Përshkrimi i projektit: Për punimin e projektit kemi përdorur HTML, JavaScript, PHP. Gjatë punimit të projektit kemi përdor librarinë e gatshme të Javascript-it për enkriptim dhe deenkriptim CryptoJs. CryptoJS mund të përdoret për të kriptuar dhe dekriptuar të dhëna me shumë algoritme kriptografike ndër to edhe DES algoritmi.

Zhvillimi i projektit: Pasi që detyra ka qenë vetëm për komunikimin vetëm nga Klienti në server, tek client.php marrim input çelësin privat dhe mesazhin. Pastaj enkriptojmë me DES mesazhin me çelësin privat. Pastaj marrim çelësin publik nga publicKey.pem dhe enkriptojmë çelësin privat të tij.

Projektin e punuan:
• Eljon Shala,
• Elma Ahmeti,
• Elonita Krasniqi.
