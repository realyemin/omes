  $(function () {
    $('#tablo').DataTable({			
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
	"responsive": true,
	"processing":true,
	"language":{ "url":"dist/plugin/datatables/Turkish.json", 
	buttons: {
                    copyTitle: "Panoya kopyalandı.",
                    copySuccess:"Panoya %d satır kopyalandı",
                    copy: "Kopyala",
                    print: "Yazdır",
					colvis:"Sütun Seç",
					excel:"Exel'e aktar",
					pdf:"Pdf'e aktar",
					
                }
	},
	dom: 'Bfrtip',   buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
        ]        
    });
  });