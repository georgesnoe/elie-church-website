import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ChurchHeader } from './church-header';

describe('ChurchHeader', () => {
  let component: ChurchHeader;
  let fixture: ComponentFixture<ChurchHeader>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ChurchHeader],
    }).compileComponents();

    fixture = TestBed.createComponent(ChurchHeader);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
