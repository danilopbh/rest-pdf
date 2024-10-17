import { Component, Inject } from '@angular/core';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material/dialog';
import { DomSanitizer, SafeResourceUrl } from '@angular/platform-browser';

@Component({
  selector: 'app-pdf-modal',
  templateUrl: './pdf-modal.component.html', // Referencia ao template externo
  styleUrls: ['./pdf-modal.component.scss']  // Referencia ao arquivo de estilos
})
export class PdfModalComponent {
  safePdfUrl: SafeResourceUrl;
  isMaximized = false;

  constructor(
    @Inject(MAT_DIALOG_DATA) public data: { pdfUrl: string },
    private sanitizer: DomSanitizer,
    private dialogRef: MatDialogRef<PdfModalComponent>
  ) {
    // Sanitizar a URL para uso seguro
    this.safePdfUrl = this.sanitizer.bypassSecurityTrustResourceUrl(data.pdfUrl);
  }

  toggleMaximize(): void {
    this.isMaximized = !this.isMaximized;
    if (this.isMaximized) {
      this.dialogRef.updateSize('100%', '100%');
    } else {
      this.dialogRef.updateSize('80%', '80%');
    }
  }

  close(): void {
    this.dialogRef.close();
  }
}