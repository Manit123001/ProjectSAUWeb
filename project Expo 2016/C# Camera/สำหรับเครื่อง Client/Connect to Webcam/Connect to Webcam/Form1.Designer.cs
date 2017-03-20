namespace Connect_to_Webcam
{
    partial class Form1
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.components = new System.ComponentModel.Container();
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(Form1));
            this.cmbListCam = new System.Windows.Forms.ComboBox();
            this.tbName = new System.Windows.Forms.TextBox();
            this.btnCapture = new System.Windows.Forms.Button();
            this.btnSave = new System.Windows.Forms.Button();
            this.timer1 = new System.Windows.Forms.Timer(this.components);
            this.pic1 = new System.Windows.Forms.PictureBox();
            this.picShow = new System.Windows.Forms.PictureBox();
            this.btnClose = new System.Windows.Forms.Button();
            this.groupBox1 = new System.Windows.Forms.GroupBox();
            this.button1 = new System.Windows.Forms.Button();
            this.label1 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            ((System.ComponentModel.ISupportInitialize)(this.pic1)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.picShow)).BeginInit();
            this.groupBox1.SuspendLayout();
            this.SuspendLayout();
            // 
            // cmbListCam
            // 
            resources.ApplyResources(this.cmbListCam, "cmbListCam");
            this.cmbListCam.FormattingEnabled = true;
            this.cmbListCam.Name = "cmbListCam";
            this.cmbListCam.SelectedIndexChanged += new System.EventHandler(this.cmbCamList1_SelectedIndexChanged);
            // 
            // tbName
            // 
            resources.ApplyResources(this.tbName, "tbName");
            this.tbName.Name = "tbName";
            this.tbName.TextChanged += new System.EventHandler(this.tbName_TextChanged);
            this.tbName.KeyPress += new System.Windows.Forms.KeyPressEventHandler(this.tbName_KeyPress);
            // 
            // btnCapture
            // 
            this.btnCapture.BackColor = System.Drawing.Color.MediumSeaGreen;
            resources.ApplyResources(this.btnCapture, "btnCapture");
            this.btnCapture.Cursor = System.Windows.Forms.Cursors.Hand;
            this.btnCapture.FlatAppearance.BorderSize = 0;
            this.btnCapture.ForeColor = System.Drawing.Color.Transparent;
            this.btnCapture.Name = "btnCapture";
            this.btnCapture.UseVisualStyleBackColor = false;
            this.btnCapture.Click += new System.EventHandler(this.button1_Click);
            // 
            // btnSave
            // 
            this.btnSave.BackColor = System.Drawing.Color.Gold;
            this.btnSave.Cursor = System.Windows.Forms.Cursors.Hand;
            resources.ApplyResources(this.btnSave, "btnSave");
            this.btnSave.FlatAppearance.BorderSize = 0;
            this.btnSave.ForeColor = System.Drawing.Color.Blue;
            this.btnSave.Name = "btnSave";
            this.btnSave.UseVisualStyleBackColor = false;
            this.btnSave.Click += new System.EventHandler(this.button2_Click);
            // 
            // timer1
            // 
            this.timer1.Interval = 1000;
            this.timer1.Tick += new System.EventHandler(this.timer1_Tick);
            // 
            // pic1
            // 
            this.pic1.BackColor = System.Drawing.SystemColors.ActiveCaption;
            resources.ApplyResources(this.pic1, "pic1");
            this.pic1.Name = "pic1";
            this.pic1.TabStop = false;
            this.pic1.DoubleClick += new System.EventHandler(this.pic1_DoubleClick);
            // 
            // picShow
            // 
            this.picShow.BackColor = System.Drawing.Color.White;
            resources.ApplyResources(this.picShow, "picShow");
            this.picShow.Name = "picShow";
            this.picShow.TabStop = false;
            this.picShow.Click += new System.EventHandler(this.picShow_Click);
            this.picShow.MouseDoubleClick += new System.Windows.Forms.MouseEventHandler(this.picShow_MouseDoubleClick);
            // 
            // btnClose
            // 
            resources.ApplyResources(this.btnClose, "btnClose");
            this.btnClose.BackColor = System.Drawing.SystemColors.MenuBar;
            this.btnClose.Cursor = System.Windows.Forms.Cursors.Hand;
            this.btnClose.FlatAppearance.BorderSize = 0;
            this.btnClose.Name = "btnClose";
            this.btnClose.UseVisualStyleBackColor = false;
            this.btnClose.Click += new System.EventHandler(this.btnCancel_Click);
            // 
            // groupBox1
            // 
            resources.ApplyResources(this.groupBox1, "groupBox1");
            this.groupBox1.Controls.Add(this.btnSave);
            this.groupBox1.Controls.Add(this.tbName);
            this.groupBox1.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.groupBox1.ForeColor = System.Drawing.Color.White;
            this.groupBox1.Name = "groupBox1";
            this.groupBox1.TabStop = false;
            this.groupBox1.Enter += new System.EventHandler(this.groupBox1_Enter);
            // 
            // button1
            // 
            this.button1.BackColor = System.Drawing.Color.Crimson;
            this.button1.Cursor = System.Windows.Forms.Cursors.Hand;
            resources.ApplyResources(this.button1, "button1");
            this.button1.FlatAppearance.BorderSize = 0;
            this.button1.ForeColor = System.Drawing.Color.Transparent;
            this.button1.Name = "button1";
            this.button1.UseVisualStyleBackColor = false;
            this.button1.Click += new System.EventHandler(this.button1_Click_1);
            // 
            // label1
            // 
            resources.ApplyResources(this.label1, "label1");
            this.label1.ForeColor = System.Drawing.Color.Transparent;
            this.label1.Name = "label1";
            // 
            // label2
            // 
            resources.ApplyResources(this.label2, "label2");
            this.label2.ForeColor = System.Drawing.Color.FromArgb(((int)(((byte)(192)))), ((int)(((byte)(0)))), ((int)(((byte)(0)))));
            this.label2.Name = "label2";
            // 
            // Form1
            // 
            resources.ApplyResources(this, "$this");
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.SystemColors.Highlight;
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.button1);
            this.Controls.Add(this.groupBox1);
            this.Controls.Add(this.picShow);
            this.Controls.Add(this.btnClose);
            this.Controls.Add(this.pic1);
            this.Controls.Add(this.btnCapture);
            this.Controls.Add(this.cmbListCam);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedToolWindow;
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "Form1";
            this.ShowIcon = false;
            this.WindowState = System.Windows.Forms.FormWindowState.Maximized;
            this.FormClosing += new System.Windows.Forms.FormClosingEventHandler(this.Form1_FormClosing);
            this.Load += new System.EventHandler(this.Form1_Load);
            ((System.ComponentModel.ISupportInitialize)(this.pic1)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.picShow)).EndInit();
            this.groupBox1.ResumeLayout(false);
            this.groupBox1.PerformLayout();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.ComboBox cmbListCam;
        private System.Windows.Forms.TextBox tbName;
        private System.Windows.Forms.Button btnCapture;
        private System.Windows.Forms.PictureBox picShow;
        private System.Windows.Forms.Button btnSave;
        private System.Windows.Forms.Timer timer1;
        private System.Windows.Forms.PictureBox pic1;
        private System.Windows.Forms.Button btnClose;
        private System.Windows.Forms.GroupBox groupBox1;
        private System.Windows.Forms.Button button1;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
    }
}

