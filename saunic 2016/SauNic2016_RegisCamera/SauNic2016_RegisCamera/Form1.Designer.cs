namespace SauNic2016_RegisCamera
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
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(Form1));
            this.picShow = new System.Windows.Forms.PictureBox();
            this.btnClose = new System.Windows.Forms.Button();
            this.pic1 = new System.Windows.Forms.PictureBox();
            this.cmbListCam = new System.Windows.Forms.ComboBox();
            this.btnCapture = new System.Windows.Forms.Button();
            this.button1 = new System.Windows.Forms.Button();
            this.groupBox1 = new System.Windows.Forms.GroupBox();
            this.tbName = new System.Windows.Forms.TextBox();
            this.btnSave = new System.Windows.Forms.Button();
            this.dgvRegister = new System.Windows.Forms.DataGridView();
            this.label1 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            ((System.ComponentModel.ISupportInitialize)(this.picShow)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.pic1)).BeginInit();
            this.groupBox1.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dgvRegister)).BeginInit();
            this.SuspendLayout();
            // 
            // picShow
            // 
            this.picShow.BackColor = System.Drawing.Color.White;
            this.picShow.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Stretch;
            this.picShow.ImeMode = System.Windows.Forms.ImeMode.NoControl;
            this.picShow.Location = new System.Drawing.Point(105, 231);
            this.picShow.Name = "picShow";
            this.picShow.Size = new System.Drawing.Size(656, 670);
            this.picShow.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage;
            this.picShow.TabIndex = 9;
            this.picShow.TabStop = false;
            this.picShow.Visible = false;
            this.picShow.MouseDoubleClick += new System.Windows.Forms.MouseEventHandler(this.picShow_MouseDoubleClick);
            // 
            // btnClose
            // 
            this.btnClose.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.btnClose.BackColor = System.Drawing.SystemColors.MenuBar;
            this.btnClose.Cursor = System.Windows.Forms.Cursors.Hand;
            this.btnClose.FlatAppearance.BorderSize = 0;
            this.btnClose.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnClose.Font = new System.Drawing.Font("Microsoft Sans Serif", 9F, System.Drawing.FontStyle.Bold);
            this.btnClose.ImeMode = System.Windows.Forms.ImeMode.NoControl;
            this.btnClose.Location = new System.Drawing.Point(80, 81);
            this.btnClose.Name = "btnClose";
            this.btnClose.Size = new System.Drawing.Size(106, 58);
            this.btnClose.TabIndex = 12;
            this.btnClose.Text = "Stop";
            this.btnClose.UseVisualStyleBackColor = false;
            this.btnClose.Visible = false;
            this.btnClose.Click += new System.EventHandler(this.btnClose_Click);
            // 
            // pic1
            // 
            this.pic1.BackColor = System.Drawing.SystemColors.ActiveCaption;
            this.pic1.BackgroundImage = ((System.Drawing.Image)(resources.GetObject("pic1.BackgroundImage")));
            this.pic1.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Stretch;
            this.pic1.ImeMode = System.Windows.Forms.ImeMode.NoControl;
            this.pic1.Location = new System.Drawing.Point(105, 231);
            this.pic1.Name = "pic1";
            this.pic1.Size = new System.Drawing.Size(656, 670);
            this.pic1.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage;
            this.pic1.TabIndex = 10;
            this.pic1.TabStop = false;
            this.pic1.Click += new System.EventHandler(this.pic1_Click);
            this.pic1.MouseDoubleClick += new System.Windows.Forms.MouseEventHandler(this.pic1_MouseDoubleClick);
            // 
            // cmbListCam
            // 
            this.cmbListCam.Font = new System.Drawing.Font("Microsoft Sans Serif", 9F);
            this.cmbListCam.FormattingEnabled = true;
            this.cmbListCam.Location = new System.Drawing.Point(105, 179);
            this.cmbListCam.Name = "cmbListCam";
            this.cmbListCam.Size = new System.Drawing.Size(260, 26);
            this.cmbListCam.TabIndex = 11;
            this.cmbListCam.Text = "Select Camera";
            this.cmbListCam.SelectedIndexChanged += new System.EventHandler(this.cmbListCam_SelectedIndexChanged);
            // 
            // btnCapture
            // 
            this.btnCapture.BackColor = System.Drawing.Color.MediumSeaGreen;
            this.btnCapture.BackgroundImage = ((System.Drawing.Image)(resources.GetObject("btnCapture.BackgroundImage")));
            this.btnCapture.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Center;
            this.btnCapture.Cursor = System.Windows.Forms.Cursors.Hand;
            this.btnCapture.FlatAppearance.BorderSize = 0;
            this.btnCapture.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnCapture.Font = new System.Drawing.Font("Microsoft Sans Serif", 10F, System.Drawing.FontStyle.Bold);
            this.btnCapture.ForeColor = System.Drawing.Color.Transparent;
            this.btnCapture.ImageAlign = System.Drawing.ContentAlignment.TopCenter;
            this.btnCapture.ImeMode = System.Windows.Forms.ImeMode.NoControl;
            this.btnCapture.Location = new System.Drawing.Point(832, 231);
            this.btnCapture.Name = "btnCapture";
            this.btnCapture.RightToLeft = System.Windows.Forms.RightToLeft.Yes;
            this.btnCapture.Size = new System.Drawing.Size(164, 159);
            this.btnCapture.TabIndex = 13;
            this.btnCapture.Text = "CAPTURE";
            this.btnCapture.TextAlign = System.Drawing.ContentAlignment.BottomCenter;
            this.btnCapture.UseVisualStyleBackColor = false;
            this.btnCapture.Click += new System.EventHandler(this.btnCapture_Click);
            // 
            // button1
            // 
            this.button1.BackColor = System.Drawing.Color.Crimson;
            this.button1.Cursor = System.Windows.Forms.Cursors.Hand;
            this.button1.FlatAppearance.BorderSize = 0;
            this.button1.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.button1.Font = new System.Drawing.Font("Microsoft Sans Serif", 11F);
            this.button1.ForeColor = System.Drawing.Color.Transparent;
            this.button1.ImeMode = System.Windows.Forms.ImeMode.NoControl;
            this.button1.Location = new System.Drawing.Point(208, 56);
            this.button1.Name = "button1";
            this.button1.Size = new System.Drawing.Size(116, 83);
            this.button1.TabIndex = 16;
            this.button1.Text = "Cancel";
            this.button1.UseVisualStyleBackColor = false;
            this.button1.Visible = false;
            this.button1.Click += new System.EventHandler(this.button1_Click);
            // 
            // groupBox1
            // 
            this.groupBox1.BackgroundImageLayout = System.Windows.Forms.ImageLayout.None;
            this.groupBox1.Controls.Add(this.tbName);
            this.groupBox1.Controls.Add(this.btnSave);
            this.groupBox1.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.groupBox1.Font = new System.Drawing.Font("Microsoft Sans Serif", 14F, System.Drawing.FontStyle.Bold);
            this.groupBox1.ForeColor = System.Drawing.Color.White;
            this.groupBox1.Location = new System.Drawing.Point(1018, 231);
            this.groupBox1.Name = "groupBox1";
            this.groupBox1.Size = new System.Drawing.Size(519, 135);
            this.groupBox1.TabIndex = 15;
            this.groupBox1.TabStop = false;
            this.groupBox1.Text = "ป้อนชื่อสกุล";
            this.groupBox1.Enter += new System.EventHandler(this.groupBox1_Enter);
            // 
            // tbName
            // 
            this.tbName.Font = new System.Drawing.Font("Microsoft Sans Serif", 14F);
            this.tbName.Location = new System.Drawing.Point(46, 57);
            this.tbName.MaxLength = 30;
            this.tbName.Name = "tbName";
            this.tbName.Size = new System.Drawing.Size(317, 34);
            this.tbName.TabIndex = 2;
            this.tbName.TextChanged += new System.EventHandler(this.tbName_TextChanged);
            this.tbName.KeyPress += new System.Windows.Forms.KeyPressEventHandler(this.tbName_KeyPress);
            this.tbName.MouseDoubleClick += new System.Windows.Forms.MouseEventHandler(this.tbName_MouseDoubleClick);
            // 
            // btnSave
            // 
            this.btnSave.BackColor = System.Drawing.Color.Gold;
            this.btnSave.Cursor = System.Windows.Forms.Cursors.Hand;
            this.btnSave.Enabled = false;
            this.btnSave.FlatAppearance.BorderSize = 0;
            this.btnSave.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btnSave.Font = new System.Drawing.Font("Microsoft Sans Serif", 14F);
            this.btnSave.ForeColor = System.Drawing.Color.Blue;
            this.btnSave.ImeMode = System.Windows.Forms.ImeMode.NoControl;
            this.btnSave.Location = new System.Drawing.Point(382, 33);
            this.btnSave.Name = "btnSave";
            this.btnSave.Size = new System.Drawing.Size(120, 83);
            this.btnSave.TabIndex = 4;
            this.btnSave.Text = "Save";
            this.btnSave.UseVisualStyleBackColor = false;
            this.btnSave.Click += new System.EventHandler(this.btnSave_Click);
            this.btnSave.KeyPress += new System.Windows.Forms.KeyPressEventHandler(this.btnSave_KeyPress);
            // 
            // dgvRegister
            // 
            this.dgvRegister.AllowUserToAddRows = false;
            this.dgvRegister.AllowUserToDeleteRows = false;
            this.dgvRegister.AutoSizeColumnsMode = System.Windows.Forms.DataGridViewAutoSizeColumnsMode.Fill;
            this.dgvRegister.BackgroundColor = System.Drawing.Color.FromArgb(((int)(((byte)(224)))), ((int)(((byte)(224)))), ((int)(((byte)(224)))));
            this.dgvRegister.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dgvRegister.Cursor = System.Windows.Forms.Cursors.Hand;
            this.dgvRegister.Location = new System.Drawing.Point(828, 419);
            this.dgvRegister.Name = "dgvRegister";
            this.dgvRegister.ReadOnly = true;
            this.dgvRegister.RowTemplate.Height = 24;
            this.dgvRegister.Size = new System.Drawing.Size(709, 482);
            this.dgvRegister.TabIndex = 3;
            this.dgvRegister.Visible = false;
            this.dgvRegister.CellContentClick += new System.Windows.Forms.DataGridViewCellEventHandler(this.dgvRegister_CellContentClick);
            this.dgvRegister.CellMouseClick += new System.Windows.Forms.DataGridViewCellMouseEventHandler(this.dgvRegister_CellMouseClick);
            this.dgvRegister.MouseClick += new System.Windows.Forms.MouseEventHandler(this.dgvRegister_MouseClick);
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Microsoft Sans Serif", 32F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(222)));
            this.label1.ForeColor = System.Drawing.Color.DeepSkyBlue;
            this.label1.Location = new System.Drawing.Point(600, 55);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(365, 63);
            this.label1.TabIndex = 17;
            this.label1.Text = "SAUNIC 2016";
            this.label1.Click += new System.EventHandler(this.label1_Click);
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Microsoft Sans Serif", 11F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(222)));
            this.label2.ForeColor = System.Drawing.Color.Crimson;
            this.label2.Location = new System.Drawing.Point(828, 192);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(141, 24);
            this.label2.TabIndex = 5;
            this.label2.Text = "ถ่ายรูปก่อนนะครับ";
            this.label2.Click += new System.EventHandler(this.label2_Click);
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.SystemColors.ControlDarkDark;
            this.ClientSize = new System.Drawing.Size(1521, 836);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.dgvRegister);
            this.Controls.Add(this.button1);
            this.Controls.Add(this.groupBox1);
            this.Controls.Add(this.btnCapture);
            this.Controls.Add(this.picShow);
            this.Controls.Add(this.btnClose);
            this.Controls.Add(this.pic1);
            this.Controls.Add(this.cmbListCam);
            this.Name = "Form1";
            this.Text = "Form1";
            this.FormClosing += new System.Windows.Forms.FormClosingEventHandler(this.Form1_FormClosing);
            this.Load += new System.EventHandler(this.Form1_Load);
            ((System.ComponentModel.ISupportInitialize)(this.picShow)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.pic1)).EndInit();
            this.groupBox1.ResumeLayout(false);
            this.groupBox1.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dgvRegister)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.PictureBox picShow;
        private System.Windows.Forms.Button btnClose;
        private System.Windows.Forms.PictureBox pic1;
        private System.Windows.Forms.ComboBox cmbListCam;
        private System.Windows.Forms.Button btnCapture;
        private System.Windows.Forms.Button button1;
        private System.Windows.Forms.GroupBox groupBox1;
        private System.Windows.Forms.Button btnSave;
        private System.Windows.Forms.TextBox tbName;
        private System.Windows.Forms.DataGridView dgvRegister;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
    }
}

