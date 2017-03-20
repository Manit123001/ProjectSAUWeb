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
using System.Data.SqlClient;

namespace SauNic2016_RegisCamera
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
            dgvRegistertable();
            captureDevice = new FilterInfoCollection(FilterCategory.VideoInputDevice);
            foreach (FilterInfo Device in captureDevice)
            {
                cmbListCam.Items.Add(Device.Name);
            }
            cmbListCam.SelectedIndex = -1;
        }


        private void cmbListCam_SelectedIndexChanged(object sender, EventArgs e)
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
            if (OnOff == true)
            {
                g = Graphics.FromImage(video2);
                g.DrawString(time.ToString(), new Font("Arial", 20), new SolidBrush(Color.White), new PointF(2, 2));
                g.Dispose();
            }
            pic1.Image = video2;

        }

        private void Form1_FormClosing(object sender, FormClosingEventArgs e)
        {
            if (cam1 != null)
                cam1.Stop();
        }

        private void btnCapture_Click(object sender, EventArgs e)
        {
            if (cam1 != null)
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

        private void groupBox1_Enter(object sender, EventArgs e)
        {

        }

        private void pic1_Click(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            picShow.Visible = false;
            btnCapture.Enabled = true;
            btnSave.Enabled = false;
        }

        // btnSave
        private void btnSave_Click(object sender, EventArgs e)
        {
            String name = tbName.Text;

            if (cam1 == null)
            {
                MessageBox.Show("Please Select Camera !!", "Warning !!");
                return;
            }
            else if (tbName.Text.Equals(""))
            {
                MessageBox.Show("ป้อนชื่อ หรือ รหัสนักศึกษาของท่าน #", "Warning !!");
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
                            picShow.Image.Save(@"C:\Users\Administrator\Google Drive\SAUNIC2016Participant\" + name + ".jpg", ImageFormat.Jpeg);

                            MySqlConnection con = new MySqlConnection("host=localhost; user=root; password=; database=db_saunic");
                            con.Open();
                            string sql = "INSERT INTO tbregister (name, time) VALUES ('" + name + "', @DATE )";
                            MySqlCommand cmd = new MySqlCommand(sql, con);

                            cmd.Parameters.AddWithValue("@DATE", DateTime.Now);
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
           
                    }

                }

            }
        }

        private void btnClose_Click(object sender, EventArgs e)
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



        private void dgvRegistertable()
        {

            MySqlConnection con = new MySqlConnection("host=localhost; user=root; password=; database=db_saunic");
            con.Open();
            string strSql = "select * from tbsaunic2016";
            MySqlCommand command = new MySqlCommand(strSql, con);
            MySqlDataAdapter da = new MySqlDataAdapter(command);
            DataTable table = new DataTable();

            da.Fill(table);
            dgvRegister.DataSource = table;

            con.Close();

            dgvRegister.Columns[0].HeaderText = "NO.";
            dgvRegister.Columns[1].HeaderText = "Name";
            dgvRegister.Columns[2].HeaderText = "LastName";
            dgvRegister.Columns[3].HeaderText = "Paper";

            dgvRegister.Columns[0].Width = 20;
            dgvRegister.Columns[1].Width = 80;
            dgvRegister.Columns[2].Width = 80;
            dgvRegister.Columns[3].Width = 80;
        }

        private void dgvRegister_CellMouseClick(object sender, DataGridViewCellMouseEventArgs e)
        {

            if (e.RowIndex >= 0)
            {
                DataGridViewRow row = this.dgvRegister.Rows[e.RowIndex];

                tbName.Text = row.Cells["firstname"].Value.ToString() + " " + row.Cells["lastname"].Value.ToString();

            }
        }


        private void tbName_KeyPress(object sender, KeyPressEventArgs e)
        {

            MySqlConnection con = new MySqlConnection("host=localhost; user=root; password=; database=db_saunic");
            con.Open();
            string strSql = "select * from tbsaunic2016 where firstname Like '%" + tbName.Text + "%'|| lastname Like '%" + tbName.Text + "%'";
            MySqlCommand command = new MySqlCommand(strSql, con);
            MySqlDataAdapter da = new MySqlDataAdapter(command);
            DataTable table = new DataTable();

            da.Fill(table);

            if (table.Rows.Count == 0)
            {
                dgvRegistertable();
            }
            else
            {
                dgvRegister.DataSource = table;
                con.Close();

                dgvRegister.Columns[0].HeaderText = "NO.";
                dgvRegister.Columns[1].HeaderText = "Name";
                dgvRegister.Columns[2].HeaderText = "LastName";
                dgvRegister.Columns[3].HeaderText = "Paper";

                dgvRegister.Columns[0].Width = 20;
                dgvRegister.Columns[1].Width = 80;
                dgvRegister.Columns[2].Width = 80;
                dgvRegister.Columns[3].Width = 80;
            }

            if (e.KeyChar == (char)Keys.Enter)
            {
                btnSave.PerformClick();
            }
        }

        private void pic1_MouseDoubleClick(object sender, MouseEventArgs e)
        {
            btnCapture.PerformClick();

        }

        private void picShow_MouseDoubleClick(object sender, MouseEventArgs e)
        {
            picShow.Visible = false;
            btnCapture.Enabled = true;
            btnSave.Enabled = false;
        }

        private void tbName_MouseDoubleClick(object sender, MouseEventArgs e)
        {
            tbName.Clear();
            tbName.Focus();
        }



        private void dgvRegister_MouseClick(object sender, MouseEventArgs e)
        {
        }


        private void dgvRegister_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {
           
        }

        private void tbName_TextChanged(object sender, EventArgs e)
        {

        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void label2_Click(object sender, EventArgs e)
        {

        }

        private void btnSave_KeyPress(object sender, KeyPressEventArgs e)
        {
            
        }


        
    }
}
