using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Net.Sockets;

namespace QVU {
    public partial class Form1 : Form {
        public Form1() {
            InitializeComponent();
        }

        TcpClient tcpClient = new TcpClient();

        private void Form1_Load(object sender, EventArgs e) {
                                    
            
        }

        private void button1_Click(object sender, EventArgs e) {

                        
            TcpClient tcpClient = new TcpClient();
            msg( "Sanal terminal başlatıldı" );
            tcpClient.Connect( "127.0.0.1", 90 );
            
            label1.Text = "Sanal terminal -" + Environment.NewLine + "QPU'ya bağlandı...";

            



            NetworkStream serverStream = tcpClient.GetStream();
            byte[] outStream;
            outStream = Encoding.ASCII.GetBytes( "#001#005#200" );
                                                            
            serverStream.Write(outStream, 0, outStream.Length);
            serverStream.Flush();

            tcpClient.Close();


        }
        public void msg(string mesg) {
            TxtBxRequestAndResponse.Text = TxtBxRequestAndResponse.Text + Environment.NewLine + " >> " + mesg;
        }
    }
}
