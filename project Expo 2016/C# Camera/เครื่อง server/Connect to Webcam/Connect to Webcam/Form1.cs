using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

using AForge;
using AForge.Video;
using AForge.Video.DirectShow;
using System.Drawing.Imaging;
using System.IO;
using MySql.Data.MySqlClient;

namespace Connect_to_Webcam
{
    public partial class Form1 : Form
    {
        Graphics g;
        Bitmap video;
        bool OnOff = false;
        int time = 3;  
        FilterInfoCollection captureDevice;
        VideoCaptureDevice cam1;
          
        public Form1()
        {
            InitializeComponent();
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            captureDevice = new FilterInfoCollection(FilterCategory.VideoInputDevice);
            foreach (FilterInfo Device in captureDevice)
            {
                cmbListCam.Items.Add(Device.Name);
            }
            cmbListCam.SelectedIndex = -1;
        }

        private void cmbCamList1_SelectedIndexChanged(object sender, EventArgs e)
        {
           
                if (cam1 != null)
                    cam1.Stop();

                cam1 = new VideoCaptureDevice(captureDevice[cmbListCam.SelectedIndex].MonikerString);
                cam1.NewFrame += new NewFrameEventHandler(cam1_NewFrame);
                cam1.Start();

        }

        void cam1_NewFrame(object sender, NewFrameEventArgs eventArgs)
        {
            video = (Bitmap)eventArgs.Frame.Clone();
            Bitmap video2 = (Bitmap)eventArgs.Frame.Clone();
            if(OnOff ==true)
            {
                g = Graphics.FromImage(video2);
                g.DrawString(time.ToString(), new Font("Arial", 20), new SolidBrush(Color.White), new PointF(2, 2));
                g.Dispose();
            }
            pic1.Image = video2;

        }

        //formClose
        private void Form1_FormClosing(object sender, FormClosingEventArgs e)
        {
            if (cam1 != null)
                cam1.Stop();
        }

        //btnCapture
        private void button1_Click(object sender, EventArgs e)
        {
            if (cam1  != null)
            {
                picShow.Visible = true;
                picShow.Image = (Bitmap)pic1.Image.Clone();
                btnCapture.Enabled = false;
                btnSave.Enabled = true;
                tbName.Focus();
            }
            else
            {
                MessageBox.Show("Please Select Camera !!", "Warning !!");
                return;
            }
                
        }

        //btnSave
        private void button2_Click(object sender, EventArgs e)
        {
            String name = tbName.Text;

            if (cam1 == null)
            {
                MessageBox.Show("Please Select Camera !!", "Warning !!");
                return;
            }
            else if(tbName.Text.Equals(""))
            {
                MessageBox.Show("ป้อนชื่อ หรือ รหัสนักศึกษาของท่าน #","Warning !!");
                tbName.Focus();
                return;
            }
            else
            {
                if (picShow.Image != null)
                {
                    if (MessageBox.Show("Thanks For Join", "Complete !!", MessageBoxButtons.YesNo, MessageBoxIcon.Information) == DialogResult.Yes)
                    {
                        try
                        {
                            picShow.Image.Save(@"C:\xampp\htdocs\expo\pictures\" + name + ".jpg", ImageFormat.Jpeg);
                            //picShow.Image.Save(@"C:\Users\Administrator\Google Drive\SAUNIC2016Participant\" + name + ".jpg", ImageFormat.Jpeg);

                            string sql = "INSERT INTO tbexposau (name_image) VALUES ('" + name + "')";
                            MySqlConnection con = new MySqlConnection("host=localhost; user=expoSAU; password=1234; database=images_expo");
                            MySqlCommand cmd = new MySqlCommand(sql, con);
                            con.Open();

                            cmd.ExecuteNonQuery();
                            con.Close();

                            tbName.Clear();
                            picShow.Visible = false;
                            picShow.Image = null;

                            btnSave.Enabled = false;
                            btnCapture.Enabled = true;

                        }
                        catch
                        {
                            MessageBox.Show("ตรวจสอบชื่อที่ป้อนอีกครั้งว่าถูกต้องหรือไม่ หรือ ชื่อที่ป้อนต้องไม่มีเครื่องหมาย / * - + \\ ^ % ", "Warning !!");
                        }


                    }
                    else
                    {
                        tbName.Focus();
                        //picShow.Image = null;
                        //picShow.Visible = false;
                    }

                } 
                else //กรณีไม่ได้กดถ่ายรูป !! 
                {
                    btnCapture.PerformClick();

                   try
                        {
                            picShow.Image.Save(@"C:\xampp\htdocs\expo\pictures\" + name + ".jpg", ImageFormat.Jpeg);

                            string sql = "INSERT INTO tbexposau (name_image) VALUES ('" + tbName.Text + "')";
                            MySqlConnection con = new MySqlConnection("host=localhost; user=root; password=; database=images_expo");
                            MySqlCommand cmd = new MySqlCommand(sql, con);
                            con.Open();

                            cmd.ExecuteNonQuery();
                            con.Close();

                            tbName.Clear();
                            picShow.Visible = false;
                            picShow.Image = null;

                            btnSave.Enabled = false;
                            btnCapture.Enabled = true;

                        }
                        catch
                        {
                            MessageBox.Show("ตรวจสอบชื่อที่ป้อนอีกครั้งว่าถูกต้องหรือไม่ หรือ ชื่อที่ป้อนต้องไม่มีเครื่องหมาย / * - + \\ ^ % ", "Warning !!");
                        }

                }
            }
        }
        //time
        private void timer1_Tick(object sender, EventArgs e)
        {
            int x = 0;
            time--;
            if( time == x)
            {
                timer1.Enabled = false;
                OnOff = false;
                picShow.Visible = true;
                picShow.Image = video;

            }
        }
        // btnAuto
        /*-private void button2_Click_1(object sender, EventArgs e)
        {
            if (pic1.Image != null) 
            {
                time = 3;
                timer1.Enabled = true;
                OnOff = true;
            }
            else
                MessageBox.Show("Please Select Camera !!", "Warning !!");
            
        }-*/

 

        private void button2_Click_2(object sender, EventArgs e)
        {
            string sql = "SELECT * FROM tbexpo";
            sql = "INSERT INTO tbexpo (name_image) VALUES ('"+ tbName.Text +"')";

            MySqlConnection con = new MySqlConnection("host=localhost; user=expoSAU; password=1234; database=display_images");
            MySqlCommand cmd = new MySqlCommand(sql, con);
            con.Open();

            /*MySqlDataReader reader = cmd.ExecuteReader();

            while(reader.Read())
            {
                MessageBox.Show(reader.GetString("name_image"));
            }*/

            cmd.ExecuteNonQuery();
            con.Close();
        }

        private void pic1_Click(object sender, EventArgs e)
        {

        }

        private void btnUpload_Click(object sender, EventArgs e)
        {

        }

        private void btnCancel_Click(object sender, EventArgs e)
        {
            if (cam1 != null)
            {
                cam1.Stop();
            }
                cam1 = null;
                pic1.Image = Image.FromFile("C:/xampp/htdocs/expo/images/webcam/webcam.png");
                picShow.Visible = false;
                picShow.Image = null;
                tbName.Clear();
                btnCapture.Enabled = true;
                btnSave.Enabled = false;
                cmbListCam.Text = "Select Camera";

            
     
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void tbName_TextChanged(object sender, EventArgs e)
        {

        }

        private void picShow_Click(object sender, EventArgs e)
        {
            
        }

        private void groupBox1_Enter(object sender, EventArgs e)
        {

        }

        private void tbName_KeyPress(object sender, KeyPressEventArgs e)
        {

            /*-if (((int)e.KeyChar >= 65 && (int)e.KeyChar <= 122 )
                || (int)e.KeyChar == 8
                 || (int)e.KeyChar == 13
                 || (int)e.KeyChar == 46)
            {
                e.Handled = false;
            }

            else if (((int)e.KeyChar >= 48 && (int)e.KeyChar <= 57)
                || (int)e.KeyChar == 8
                 || (int)e.KeyChar == 13
                 || (int)e.KeyChar == 46
                || (int)e.KeyChar == 32)
            {
                e.Handled = false;
            }
            else
            {
                e.Handled = true;
            }-*/
            

            /*-if ((int)e.KeyChar >= 44 && (int)e.KeyChar <= 57  &&
            (e.KeyChar != '0') &&
            (e.KeyChar != '1') &&
            (e.KeyChar != '2') &&
            (e.KeyChar != '3') &&
            (e.KeyChar != '4') &&
            (e.KeyChar != '5') &&
            (e.KeyChar != '6') &&
            (e.KeyChar != '7') &&
            (e.KeyChar != '8') &&
            (e.KeyChar != '9') &&
            (e.KeyChar != '.') )
            {
                //MessageBox.Show("ไม่สามารถใส่ตัวเลขได้ !", "ตรวจพบข้อผิดพลาด", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                e.Handled = true;
            }
            else if (((int)e.KeyChar >= 48 && (int)e.KeyChar <= 122) || (int)e.KeyChar >= 161 || (int)e.KeyChar == 8 || (int)e.KeyChar == 13 || (int)e.KeyChar == 46 || (int)e.KeyChar == 32)
            {
                e.Handled = false;
            }-*/

           

            if((e.KeyChar == '.')&& ((sender as TextBox).Text.IndexOf('.')>-1)){
                e.Handled = true;
            }

            if (e.KeyChar == (char)Keys.Enter)
            {
                btnSave.PerformClick();
            }

    }

        private void button1_Click_1(object sender, EventArgs e)
        {
            picShow.Visible = false;
            btnCapture.Enabled = true;
            btnSave.Enabled = false;
        }

        private void button2_Click_1(object sender, EventArgs e)
        {

        }

        private void pic1_DoubleClick(object sender, EventArgs e)
        {
            btnCapture.PerformClick();

        }

        private void textBox1_TextChanged(object sender, EventArgs e)
        {

        }

        private void picShow_MouseDoubleClick(object sender, MouseEventArgs e)
        {
            picShow.Visible = false;
            btnCapture.Enabled = true;
            btnSave.Enabled = false;
        }

        private void pic1_Click_1(object sender, EventArgs e)
        {

        }






    }
}
