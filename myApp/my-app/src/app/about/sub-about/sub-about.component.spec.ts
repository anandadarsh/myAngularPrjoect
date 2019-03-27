import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SubAboutComponent } from './sub-about.component';

describe('SubAboutComponent', () => {
  let component: SubAboutComponent;
  let fixture: ComponentFixture<SubAboutComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SubAboutComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SubAboutComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
